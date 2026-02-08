<?php

namespace App\Http\Controllers\Dependent;

use App\Models\Dependent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\BeneficiaryPlan;

class DependentAreaController
{
    public function index()
    {
        $dependent = Auth::guard('dependent')->user();
        $beneficiary = $dependent->beneficiary;
        if ($beneficiary->isInadimplente()) {
            // Adicionar a logica caso esteja inadiplente
            return redirect()->route('dependent.login')->withErrors([
                'pagamento' => 'O Beneficiário está inadiplente.',
            ]);
        }
        $cpfBeneficiary = preg_replace('/\D/', '', $beneficiary->cpf);
        $cpfDependent = preg_replace('/\D/', '', $dependent->cpf);

        $ibam = new \App\Services\IBAMService("https://sistema.ibambeneficios.com.br/api/external/");
        $ibam->login();

        // =====================================================
        // 1) LISTAR DEPENDENTES NO IBAM
        // =====================================================
        $list = $ibam->listDependents($cpfBeneficiary);

        $docwayDependentId = null;

        if (
            isset($list['response']['success']) &&
            $list['response']['success'] === true &&
            is_array($list['response']['data'])
        ) {
            foreach ($list['response']['data'] as $item) {
                if (
                    isset($item['cpf']) &&
                    preg_replace('/\D/', '', $item['cpf']) === $cpfDependent
                ) {
                    $docwayDependentId = $item['docway_dependent_id'] ?? null;
                    break;
                }
            }
        }

        // =====================================================
        // 2) NÃO EXISTE NO IBAM → CRIAR
        // =====================================================
        if (!$docwayDependentId) {

            $create = $ibam->createDependent($cpfBeneficiary, [
                "name" => $dependent->name,
                "cpf" => $cpfDependent,
                "email" => $dependent->email,
                "phone" => $dependent->phone,
                "birth_date" => $dependent->birth_date,
                "gender" => $dependent->gender,
                "mother_name" => $dependent->mother_name,
                "relationship" => $dependent->relationship ?? 'Dependente'
            ]);

            if (
                !isset($create['response']['success']) ||
                $create['response']['success'] !== true
            ) {
                return back()->withErrors('Erro ao sincronizar dependente com IBAM.');
            }

            $docwayDependentId = $create['response']['data']['docway_dependent_id'] ?? null;

            if (!$docwayDependentId) {
                return back()->withErrors('IBAM não retornou ID do dependente.');
            }
        }

        // =====================================================
        // 3) ATUALIZA LOCAL
        // =====================================================
        if ($dependent->docway_dependent_id !== $docwayDependentId) {
            $dependent->docway_dependent_id = $docwayDependentId;
            $dependent->save();
        }

        // =====================================================
        // 4) PLANOS (HERDADOS DO TITULAR)
        // =====================================================
        $plans = BeneficiaryPlan::where('beneficiary_id', $beneficiary->id)
            ->with([
                'plan.conveniences.convenio.partner',
                'plan.conveniences.convenio.type',
                'plan.conveniences.convenio.categoria'
            ])
            ->get()
            ->map(fn($bp) => $bp->plan);

        return view('pages.dependents.area.index', compact('dependent', 'plans'));
    }

    /**
     * Telemedicina – Dependente
     */
    public function telemedicine(Request $request)
    {
        $dependent = Auth::guard('dependent')->user();
        $beneficiary = $dependent->beneficiary;
        $cpfBeneficiary = preg_replace('/\D/', '', $beneficiary->cpf);
        $cpfDependent = preg_replace('/\D/', '', $dependent->cpf);
        $date = now()->format('Y-m-d');

        // Lógica de Especialidade por Idade: < 12 anos = Pediatra (2), >= 12 anos = Clínico Geral (1)
        $birthDate = \Carbon\Carbon::parse($dependent->birth_date);
        $age = $birthDate->age;
        $specialtyId = ($age < 12) ? 2 : 1;

        $availableHours = [];

        try {
            $ibam = new \App\Services\IBAMService("https://sistema.ibambeneficios.com.br/api/external/");
            $ibam->login();

            // garante que o dependente exista no IBAM
            if (!$dependent->docway_dependent_id) {
                return redirect()
                    ->route('dependent.area.index')
                    ->withErrors('Dependente não sincronizado com a IBAM.');
            }

            // Docway usa o paciente TITULAR para agenda
            $beneficiaryIbam = $ibam->findBeneficiary($cpfBeneficiary);

            if (
                isset($beneficiaryIbam['response']['exists']) &&
                $beneficiaryIbam['response']['exists'] === true
            ) {
                $docwayPatientId = $beneficiaryIbam['response']['data']['docway_patient_id'];

                $response = $ibam->medcareAvailableHours(
                    $docwayPatientId,
                    $specialtyId, // Clínico Geral ou Pediatra
                    $date
                );

                if ($response['status'] === 200) {
                    $availableHours = $response['response'];
                }
            }
        } catch (\Exception $e) {
            $availableHours = [];
        }

        return view('pages.dependents.area.telemedicine', [
            'dependent' => $dependent,
            'specialtyId' => $specialtyId,
            'date' => $date,
            'availableHours' => $availableHours
        ]);
    }

    /**
     * Redireciona dependente para telemedicina
     */
    public function redirectToTelemedicine(Request $request)
    {
        $request->validate([
            'hour' => 'required'
        ]);

        $dependent = Auth::guard('dependent')->user();
        $beneficiary = $dependent->beneficiary;

        $cpfBeneficiary = preg_replace('/\D/', '', $beneficiary->cpf);
        $dateTime = $request->hour;

        $ibam = new \App\Services\IBAMService("https://sistema.ibambeneficios.com.br/api/external/");
        $ibam->login();

        // busca titular no IBAM
        $exists = $ibam->findBeneficiary($cpfBeneficiary);

        if (
            !isset($exists['response']['exists']) ||
            $exists['response']['exists'] !== true
        ) {
            return back()->withErrors('Titular não encontrado na IBAM.');
        }

        $docwayPatientId = $exists['response']['data']['docway_patient_id'];

        // Calcula especialidade por idade: < 12 anos = Pediatra (2), >= 12 anos = Clínico Geral (1)
        $age = \Carbon\Carbon::parse($dependent->birth_date)->age;
        $specialtyId = ($age < 12) ? 2 : 1;

        // inicia atendimento PARA DEPENDENTE
        $medcare = $ibam->medcareCreate($docwayPatientId, [
            "specialty_id" => $specialtyId,
            "date_time" => $dateTime,
            "docway_dependent_id" => $dependent->docway_dependent_id
        ]);

        if (
            !isset($medcare['response']['success']) ||
            $medcare['response']['success'] !== true
        ) {
            $errorMessage = $medcare['response']['error'] ?? '';

            if (str_contains($errorMessage, 'já agendado')) {
                $msg = 'Você já possui um agendamento neste horário.';
            } elseif (str_contains($errorMessage, 'atendimento em aberto')) {
                $msg = 'Você já possui um atendimento em andamento.';
            } else {
                $msg = 'Não foi possível iniciar o atendimento médico.';
            }

            return redirect()
                ->route('dependent.area.telemedicine')
                ->withErrors(['msg' => $msg]);
        }

        return redirect()->away($medcare['response']['data']['videoRoomLink']);
    }

    /**
     * Lista de agendamentos – Dependente
     */
    public function schedules()
    {
        $dependent = Auth::guard('dependent')->user();
        $beneficiary = $dependent->beneficiary;

        // Normaliza CPF do beneficiário
        $cpfDependent = preg_replace('/\D/', '', $dependent->cpf);

        $service = new \App\Services\IBAMService(
            "https://sistema.ibambeneficios.com.br/api/external/"
        );

        $service->login();

        // 🔥 LISTA DIRETA DE ATENDIMENTOS DO DEPENDENTE
        $result = $service->medcareListDependent($cpfDependent);

        $appointments = $result['response']['records'] ?? [];

        return view(
            'pages.dependents.area.schedules',
            compact('appointments')
        );
    }



    /**
     * Redireciona para tela de edição de dados do dependente
     */
    public function profileEdit()
    {
        $profile = Auth::guard('dependent')->user();

        return view('pages.dependents.area.edit', compact('profile'));
    }


    /**
     * Atualiza os dados do perfil autenticado
     */
    public function profileUpdate(Request $request)
    {

        $data = $request->validate(
            [
                'email' => 'required|string',
                'password' => 'nullable|string',
                'phone' => 'required',
                'birth_date' => 'required',
            ]
        );

        $profile = Auth::guard('dependent')->user();

        try {
            $profile = Dependent::findOrFail($profile->id);

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $profile->update($data);

            return redirect()->route('dependent.area.index')
                ->with('sucesso', 'Os dados do dependente foram atualizados com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao editar seus dados: ' . $e);
        }

    }
}