# Checklist de Migração: Desacoplamento do Asaas

Este documento rastreia todos os pontos de amarração direta com o Asaas que precisam ser refatorados para permitir a migração de gateway.

## 1. Configurações e Ambiente
- [x] `.env`: Remover/Substituir `ASAAS_TOKEN` e `ASAAS_URL`.
- [x] `config/services.php`: Remover entrada `asaas` e criar uma estrutura genérica para `payment_gateway`. (Adicionado suporte a múltiplos drivers: Asaas e Cielo)

## 2. Banco de Dados (Migrations/Models)
- [x] Adicionar coluna `payment_gateway` com valor padrão `asaas` nas tabelas `beneficiaries` e `invoices`.
- [ ] `database/migrations/2025_11_24_162838_create_invoices_table.php`: Renomear `asaas_payment_id` para `gateway_payment_id`. (Pendente - Opção B: Gradual)
- [ ] `app/Models/Beneficiary.php`: Renomear atributo `asaas_customer_id` para `gateway_customer_id`. (Pendente - Opção B: Gradual)
- [ ] Criar migration para renomear as colunas acima em produção. (Pendente - Opção B: Gradual)

## 3. Camada de Serviços (Services) - **Ação Principal**
- [x] Criar `app/Contracts/PaymentGatewayInterface.php`.
- [x] Criar `app/Services/Payment/AsaasAdapter.php` (Implementando a Interface com o código atual).
- [x] Criar `app/Services/Payment/CieloAdapter.php` (Implementação inicial para Crédito).
- [x] Implementar Débito no `CieloAdapter.php` (Migrado para Braspag v2 com suporte a 3DS e regra Elo 2025).
- [x] Implementar Cancelamento de Assinatura no `CieloAdapter.php` (Estorno/Void via Braspag v2).
- [x] Configurar Atualização de Cartão no `CieloAdapter.php` (Redirecionamento para suporte via e-mail: telemedicina@boxfarma.co).
- [x] Refatorar `BeneficiaryAreaController.php` para busca agnóstica de faturas (Cielo/Asaas).
- [x] Refatorar `SubscriptionCancellationService.php` para lógica híbrida: Cancelar na API se Crédito, apenas inativar localmente se Débito.
- [x] Configurar `AppServiceProvider.php` para vincular a Interface ao Adaptador.
- [x] `app/Services/BeneficiaryService.php`: Remover chamada direta ao `AsaasCustomerService`. (Refatorado para usar `PaymentGatewayInterface`)
- [x] `app/Services/SubscriptionCancellationService.php`: Remover dependência do `AsaasService`. (Refatorado para usar `PaymentGatewayInterface`)

## 4. Controladores (Controllers)
- [x] `app/Http/Controllers/Admin/CheckoutController.php`: Substituir `AsaasPaymentService` e `AsaasCustomerService` pela Interface genérica. (Refatorado para usar `PaymentGatewayInterface` via Injeção de Dependência)
- [x] `app/Http/Controllers/Beneficiary/BeneficiaryAreaController.php`: Remover chamadas diretas ao `AsaasService` para atualização de cartão. (Refatorado para usar `PaymentGatewayInterface`)

## 5. Comandos de Console e Sincronização
- [x] `app/Console/Commands/PaymentSyncInvoices.php`: Criado comando genérico que suporta Asaas e Cielo simultaneamente.
- [x] `app/Console/Kernel.php`: Agendado o novo comando `payment:sync-invoices`.
- [x] Desativar `AsaasSyncInvoices.php` (Substituído pelo novo comando genérico).

## 6. Documentação e Frontend
- [x] `resources/views/documentation/index.blade.php`: Atualizada a documentação para refletir o novo sistema multi-gateway.
- [x] `resources/views/pages/checkout/index.blade.php`: Garantir que os tipos de pagamento enviados (`CREDIT_CARD`, `DEBIT_CARD`) sejam compatíveis com a nova interface.

---

## 7. Correções Identificadas em Testes
- [x] Padronização de Named Parameters: Renomeado `$cardData` para `$creditCard` na Interface e Adaptadores para compatibilidade com o PHP 8 no `CheckoutController`.
- [x] Padronização de Retorno do Gateway: Adicionadas chaves `value`, `status`, `billingType` e `nextDueDate` no retorno do `CieloAdapter` para compatibilidade com o `InvoiceService`.
- [x] Blindagem do `InvoiceService`: Adicionado tratamento para chaves ausentes no array de pagamento e fallback para o valor do plano local.
- [x] Persistência de Dados (Fillable): Adicionado `payment_gateway` ao `$fillable` dos Models `Beneficiary` e `Invoice`.
- [x] Correção de Fluxo de Autenticação: Invertida a ordem de `session()->regenerate()` e `Auth::login()` no Checkout para garantir a persistência da sessão.

## 8. Implementação Débito Cielo (3DS 2.0)
- [x] Criar método `getAccessToken()` no `CieloAdapter.php` para OAuth.
- [x] Criar rota/controller para fornecer o Access Token ao Front-end.
- [x] Mapear classes `bpmpi_` no `resources/views/pages/checkout/index.blade.php`.
- [x] Implementar lógica JavaScript para interceptar checkout de débito e disparar `bpmpi_authenticate()`.
- [x] Ajustar `createSubscription` no `CieloAdapter.php` para processar `DEBIT_CARD` com `ExternalAuthentication`.
- [x] Migração para Braspag v2: Atualizados endpoints de `/1/sales` para `/v2/sales` e adicionado suporte ao provedor "Simulado" para Sandbox.
- [x] Conformidade Elo 2025: Adicionado campo `SolutionType` para transações da bandeira Elo.
- [x] Validar captura de `RecurrentPaymentId` no retorno da Cielo para Débito.
