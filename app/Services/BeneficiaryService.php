<?php


namespace App\Services;

use App\Contracts\PaymentGatewayInterface;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class BeneficiaryService
{
    protected $gateway;

    public function __construct(PaymentGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Cria um novo beneficiario;
     * usa a interface de gateway para gerenciar o customer
     */
    public function createBeneficiary($request, $companyUuid)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'cpf' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'birth_date' => 'required',
                'gender' => 'required',
                'password' => 'required',
                'mother_name' => 'required',
            ],
            [
                'name.required' => 'O campo nome é obrigatório.',
                'cpf.required' => 'O campo CPF é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'phone.required' => 'O campo telefone é obrigatório.',
                'birth_date.required' => 'O campo data de nascimento é obrigatório.',
                'gender.required' => 'O campo gênero é obrigatório.',
                'password.required' => 'O campo senha é obrigatório.',
                'mother_name.required' => 'O campo nome da mãe é obrigatório.',
            ]
        );

        try {

            $companyId = Company::where('uuid', $companyUuid)->firstOrFail()->id;

            // 🔍 1. VERIFICA SE BENEFICIÁRIO JÁ EXISTE
            $existing = Beneficiary::where('cpf', $data['cpf'])
                ->orWhere('email', $data['email'])
                ->first();

            if ($existing) {

                // 🔄 Se existir mas ainda não tiver customer no gateway — tenta criar agora
                if (!$existing->asaas_customer_id) {
                    $customerId = $this->gateway->createCustomer($existing);

                    if ($customerId) {
                        $existing->update([
                            'asaas_customer_id' => $customerId,
                            'payment_gateway' => config('services.payment_gateway.driver', 'asaas')
                        ]);
                    }
                }

                return $existing; // retorna o beneficiário existente
            }


            // 🆕 2. SE NÃO EXISTIR → CRIA
            $beneficiary = Beneficiary::create([
                'company_id' => $companyId,
                'name' => $data['name'],
                'cpf' => $data['cpf'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'birth_date' => $data['birth_date'],
                'gender' => $data['gender'],
                'relationship' => 'Titular',
                'mother_name' => $data['mother_name'],
                'password' => Hash::make($data['password']),
                'payment_gateway' => config('services.payment_gateway.driver', 'asaas')
            ]);

            // 🔗 3. CRIA customer no Gateway (se o gateway exigir)
            $customerId = $this->gateway->createCustomer($beneficiary);

            if ($customerId) {
                $beneficiary->update([
                    'asaas_customer_id' => $customerId
                ]);
            }

            return $beneficiary;

        } catch (\Exception $e) {
            throw $e;
        }
    }

}
