<?php

namespace App\Http\Controllers\Beneficiary;

use App\Contracts\PaymentGatewayInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;
use App\Models\BeneficiaryPlan;
use Illuminate\Http\Request;
use App\Models\Dependent;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\Hash;
use App\Services\SubscriptionCancellationService;
use Exception;

class BeneficiaryAreaController extends Controller
{
    protected $gateway;

    public function __construct(PaymentGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Controller de gestão da área do Beneficiário
     */

    public function index()
    {
        $beneficiary = Auth::guard('beneficiary')->user();
        
        \Log::info("Acessando BeneficiaryAreaController@index para o beneficiário ID: " . ($beneficiary->id ?? 'NÃO LOGADO'));

        if (!$beneficiary) {
            \Log::error("Acesso negado: Beneficiário não está autenticado no guard 'beneficiary'.");
            return redirect()->route('beneficiary.login');
        }

        if ($beneficiary->isInadimplente()) {
            \Log::warning("Beneficiário ID {$beneficiary->id} redirecionado por inadimplência.");
            // Adicionar a logica caso esteja inadiplente
        }

        $cpf = preg_replace('/\D/', '', $beneficiary->cpf);

        // INSTANCIA SERVIÇO IBAM
        $ibam = new \App\Services\IBAMService("https://sistema.ibambeneficios.com.br/api/external/");
        
        try {
            $ibam->login();

            // 1) CONSULTA NA API DO IBAM
            $exists = $ibam->findBeneficiary($cpf);
            $docwayUuid = null;
            if (
                isset($exists['response']['exists']) &&
                $exists['response']['exists'] === true &&
                isset($exists['response']['data']['docway_patient_id'])
            ) {
                // Já existe na IBAM
                $docwayUuid = $exists['response']['data']['docway_patient_id'];
            } else {

                // 2) NÃO EXISTE → CRIAR AUTOMATICAMENTE
                $create = $ibam->createBeneficiary([
                    "name" => $beneficiary->name,
                    "cpf" => $cpf,
                    "email" => $beneficiary->email,
                    "phone" => $beneficiary->phone,
                    "birth_date" => $beneficiary->birth_date,
                    "gender" => $beneficiary->gender,
                    "mother_name" => $beneficiary->mother_name,
                    "relationship" => "Titular"
                ]);

                // Reconsulta para obter ID correto
                $create = $ibam->findBeneficiary($cpf);

                if (!isset($create['response']['success']) || $create['response']['success'] !== true) {
                    return back()->withErrors("Erro ao sincronizar beneficiário com IBAM.");
                }

                $docwayUuid = $create['response']['uuid'] ?? null;

                if (!$docwayUuid) {
                    return back()->withErrors("IBAM não retornou UUID do beneficiário.");
                }

                // 3) Atualiza beneficiário localmente (opcional)
                $beneficiary->docway_patient_id = $docwayUuid;
                $beneficiary->save();
            }
        } catch (\Exception $e) {
            \Log::error("Erro IBAM no index: " . $e->getMessage());
        }

        // CARREGA OS PLANOS
        $plans = BeneficiaryPlan::where('beneficiary_id', $beneficiary->id)
            ->with(['plan.conveniences.convenio.partner', 'plan.conveniences.convenio.type', 'plan.conveniences.convenio.categoria'])
            ->get()
            ->map(fn($bp) => $bp->plan);

        return view('pages.beneficiaries.area.index', compact('beneficiary', 'plans'));
    }


    /**
     * Redireciona para tela de edição de dados do titular
     */
    public function profileEdit()
    {
        $profile = Auth::guard('beneficiary')->user();

        return view('pages.beneficiaries.area.edit', compact('profile'));
    }


    /**
     * Atualiza os dados do perfil autenticado
     */
    public function profileUpdate(Request $request){

        $data = $request->validate(
            [
                'email' => 'required|string',
                'password' => 'nullable|string',
                'phone' => 'required',
                'birth_date' => 'required',
            ]
        );

        $profile = Auth::guard('beneficiary')->user();

        try {
            $profile = Beneficiary::findOrFail($profile->id);

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
            
            $profile->update($data);

            return redirect()->route('beneficiary.area.index')
                    ->with('sucesso', 'Os dados do beneficiário foram atualizados com sucesso!');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors('Erro ao editar seus dados: '.$e);
        }

    }



    /**
     * Exibir detalhes de um plano
     */
    public function planDetails($planId)
    {
        $plan = Plan::with([
            'company',
            'conveniences.convenio.partner',
            'conveniences.convenio.type',
            'conveniences.convenio.categoria'
        ])->findOrFail($planId);

        return view('pages.beneficiaries.area.planDetails', compact('plan'));
    }


    
    public function updateCreditCard(Request $request)
    {
        $beneficiary = auth('beneficiary')->user();

        // 🔍 Busca a última invoice independente do prefixo (Asaas ou Cielo)
        $subscriptionInvoice = $beneficiary->invoices()
            ->orderByDesc('created_at')
            ->first();

        if (!$subscriptionInvoice) {
            return back()->withErrors('Assinatura não encontrada.');
        }

        $subscriptionId = $subscriptionInvoice->asaas_payment_id;

        // 🔒 Monta dados do cartão
        $creditCard = [
            'holderName'  => $request->card_holder,
            'number'      => preg_replace('/\D/', '', $request->card_number),
            'expiryMonth' => $request->card_month,
            'expiryYear'  => $request->card_year,
            'ccv'         => $request->ccv,
        ];

        // 🔒 Dados do titular
        $holderInfo = [
            'name'          => $beneficiary->name,
            'email'         => $beneficiary->email,
            'cpfCnpj'       => $beneficiary->cpf,
            'postalCode'    => preg_replace('/\D/', '', $request->postal_code),
            'addressNumber' => $request->address_number,
            'addressComplement' => null,
            'phone'         => $beneficiary->phone,
            'mobilePhone'   => $beneficiary->phone,
        ];

        try {
            $this->gateway->updateSubscriptionCreditCard(
                $subscriptionId,
                $creditCard,
                $holderInfo,
                $request->ip() // 🔥 remoteIp obrigatório
            );

            return back()->with('sucesso', 'Cartão atualizado com sucesso.');

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Telemedicina
     */
    public function telemedicine(Request $request)
    {
        $beneficiary = Auth::guard('beneficiary')->user();
        $cpf = preg_replace('/\D/', '', $beneficiary->cpf);
        // parâmetros recebidos (opcionais)
        $date = now()->format('Y-m-d');
        $availableHours = [];
        // Só busca horários se a especialidade foi informada
        try {
            $ibam = new \App\Services\IBAMService("https://sistema.ibambeneficios.com.br/api/external/");
            $ibam->login();
            $exists = $ibam->findBeneficiary($cpf);
            if (
                isset($exists['response']['exists']) &&
                $exists['response']['exists'] === true &&
                isset($exists['response']['data']['docway_patient_id'])
            ) {
                // Já existe na IBAM
                $docwayUuid = $exists['response']['data']['docway_patient_id'];
                $response = $ibam->medcareAvailableHours(
                    $docwayUuid,
                    1,
                    $date
                );
                if ($response["status"] === 200) {
                    $availableHours = $response["response"];
                }
            }
        } catch (\Exception $e) {
            $availableHours = [];
        }
        return view('pages.beneficiaries.area.telemedicine', [
            'beneficiary' => $beneficiary,
            'specialtyId' => 1,
            'date' => $date,
            'availableHours' => $availableHours
        ]);
    }


    // redirect to docway service
    public function redirectToTelemedicine(Request $request)
    {
        $request->validate([
            'hour' => 'required'
        ]);

        $beneficiary = Auth::guard('beneficiary')->user();
        $cpf = preg_replace('/\D/', '', $beneficiary->cpf);
        $specialtyId = 1;

        // cria o datetime final
        $dateTime = $request->hour;

        // ============================================================
        // 1) INSTÂNCIA DO SERVICE IBAM
        // ============================================================
        $ibam = new \App\Services\IBAMService("https://sistema.ibambeneficios.com.br/api/external/");
        $ibam->login();

        // ============================================================
        // 2) VERIFICAR SE O BENEFICIÁRIO EXISTE
        // ============================================================
        $exists = $ibam->findBeneficiary($cpf);

        $docwayUuid = null;
        if (
            isset($exists['response']['exists']) &&
            $exists['response']['exists'] === true &&
            isset($exists['response']['data']['docway_patient_id'])
        ) {
            $docwayUuid = $exists['response']['data']['docway_patient_id'];

        } else {
            // CRIAR BENEFICIÁRIO NO IBAM
            $create = $ibam->createBeneficiary([
                "name" => $beneficiary->name,
                "cpf" => $cpf,
                "email" => $beneficiary->email,
                "phone" => $beneficiary->phone,
                "birth_date" => $beneficiary->birth_date,
                "gender" => $beneficiary->gender,
                "mother_name" => $beneficiary->mother_name,
                "relationship" => "Titular"
            ]);

            $create = $ibam->findBeneficiary($cpf);

            if (
                !isset($create['response']['success']) ||
                $create['response']['success'] !== true
            ) {
                return back()->withErrors("Erro ao criar beneficiário IBAM.");
            }

            $docwayUuid = $create['response']['uuid'] ?? null;

            if (!$docwayUuid) {
                return back()->withErrors("Erro: IBAM não retornou UUID do beneficiário.");
            }
        }

        // ============================================================
        // 4) INICIAR ATENDIMENTO MÉDICO (AGENDADO)
        // ============================================================
        $medcare = $ibam->medcareCreate($docwayUuid, [
            "specialty_id" => $specialtyId,
            "date_time" => $dateTime
        ]);

        if (
            !isset($medcare['response']['success']) ||
            $medcare['response']['success'] !== true
        ) {
            $errorMessage = $medcare['response']['error'] ?? '';
            // 🔥 TRATAMENTO INTELIGENTE DE ERROS DOCWAY
            if (str_contains($errorMessage, 'já agendado')) {
                // Mensagem do tipo: Paciente já agendado para esse horário
                $userMessage = 'Você já possui um agendamento neste horário. Escolha outro horário disponível.';
            }
            elseif (str_contains($errorMessage, 'atendimento em aberto')) {
                // Mensagem do tipo: Paciente já possui um atendimento em aberto.
                $userMessage = 'Você já possui um atendimento médico em andamento. Finalize-o antes de iniciar um novo.';
            }
            else {
                $userMessage = 'Não foi possível iniciar o atendimento médico. Tente novamente mais tarde.';
            }
            return redirect()
                ->route('beneficiary.area.telemedicine')
                ->withErrors(['msg' => $userMessage]);
        }


        // ============================================================
        // 5) REDIRECIONAR PARA A SALA DOCWAY
        // ============================================================
        return redirect()->away($medcare['response']['data']['videoRoomLink']);
    }




    /**
     * Lista de dependentes do beneficiário
     */
    public function dependents()
    {

        $beneficiary = Auth::guard('beneficiary')->user();
        $dependents = Dependent::whereNull('deleted_at')
            ->where('beneficiary_id', $beneficiary->id)
            ->orderBy('name', 'asc')
            ->get();

        return view('pages.beneficiaries.area.dependents', compact('beneficiary', 'dependents'));

    }



    /**
     * Tela de Agendamentos
     */
    public function schedules()
    {
        $beneficiary = Auth::guard('beneficiary')->user();
        $cpf = preg_replace('/\D/', '', $beneficiary->cpf);
        $service = new \App\Services\IBAMService("https://sistema.ibambeneficios.com.br/api/external/");
        $service->login();
        $beneficiaryIbam = $service->findBeneficiary($cpf);
        if (!$beneficiaryIbam['response']['success']) {
            return view('pages.beneficiaries.area.schedules')
                ->with('appointments', []);
        }
        $result = $service->medcareList($beneficiaryIbam['response']['data']['docway_patient_id']);
        $appointments = $result['response']['records'] ?? [];
        return view('pages.beneficiaries.area.schedules', compact('appointments'));
    }

     /**
      * Summary of cancel
      * @param Request $request
      * @return \Illuminate\Http\RedirectResponse
      */
     public function cancel(Request $request)
    {
        try {
            $beneficiary = auth('beneficiary')->user();

            app(SubscriptionCancellationService::class)
                ->requestCancellation($beneficiary);

            return redirect()
                ->route('beneficiary.area.index')
                ->with(
                    'success',
                    'Sua assinatura foi cancelada. Você continuará com acesso até o fim do período pago.'
                );

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

}
