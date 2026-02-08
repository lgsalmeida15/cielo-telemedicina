# Plano Técnico de Migração de Gateway de Pagamento

## 1. Diagnóstico Atual
A aplicação utiliza atualmente o **Asaas** como gateway de pagamento. A integração está profundamente acoplada ao código através de múltiplos Services e Controllers, utilizando chamadas diretas via CURL e a Facade `Http` do Laravel.

### Componentes Identificados:
- **Gateway Atual:** Asaas
- **Services Principais:**
  - `AsaasPaymentService.php`: Criação de pagamentos (Pix/Boleto) e Assinaturas (Cartão).
  - `AsaasCustomerService.php`: Gestão de clientes no gateway.
  - `AsaasService.php`: Operações auxiliares (Sync, Cancelamento, Portal).
- **Ponto Crítico de Entrada:** `CheckoutController.php` (Processa as vendas e assinaturas).
- **Sincronização:** `AsaasSyncInvoices.php` (Comando de console para atualizar status).

---

## 2. Mapa de Dependências (Onde mudar)

| Local | Responsabilidade | Impacto |
| :--- | :--- | :--- |
| `.env` | Chaves de API e URL do Gateway | Alto |
| `config/services.php` | Configurações de credenciais | Médio |
| `app/Services/Asaas...` | Lógica de comunicação com a API | **Crítico** |
| `app/Http/Controllers/Admin/CheckoutController.php` | Fluxo de finalização de compra | Alto |
| `app/Console/Commands/AsaasSyncInvoices.php` | Atualização automática de status | Médio |
| `database/migrations/...invoices_table.php` | Campos como `asaas_payment_id` | Baixo (Refatorar nomes) |

---

## 3. Plano de Ação: A "Melhor Forma" (Abstração)

Para evitar que futuras trocas de gateway exijam uma varredura completa novamente, a melhor estratégia é implementar o **Pattern Strategy** com uma **Interface de Pagamento**.

### Passo a Passo Sugerido:

1.  **Criação de uma Interface:**
    Criar `app/Contracts/PaymentGatewayInterface.php` definindo métodos padrão: `createCustomer()`, `createPayment()`, `createSubscription()`, `cancelSubscription()`.

2.  **Implementação do Novo Gateway:**
    Criar um novo Service (ex: `StripeGatewayService.php`) que implementa essa Interface.

3.  **Refatoração do Checkout:**
    Em vez de chamar `app(AsaasPaymentService::class)`, o Controller deve pedir ao Laravel a `PaymentGatewayInterface`. O Laravel injetará o gateway configurado no momento.

4.  **Migração de Dados:**
    *   Manter os IDs do Asaas para assinaturas legadas.
    *   Novas assinaturas utilizam o novo Gateway.
    *   Criar um script de "Double-Write" ou migração em lote se necessário.

---

## 4. Resumo Visual das Mudanças

```mermaid
graph TD
    A[CheckoutController] -->|Pede Interface| B(PaymentGatewayInterface)
    B -->|Implementa| C[AsaasService (Atual)]
    B -.->|Nova Implementação| D[Novo Gateway (Futuro)]
    
    subgraph "Camada de Abstração"
    B
    end
    
    subgraph "Gateways"
    C
    D
    end
```

### O que remover/substituir:
- [ ] Referências diretas a `asaas_customer_id` no banco (renomear para `gateway_customer_id`).
- [ ] Chamadas CURL manuais dentro de `AsaasPaymentService`.
- [ ] Hardcode de URLs do Asaas em Services.

---

**Recomendação Final:** Não substitua "Asaas por Gateway X" diretamente nos arquivos existentes. Crie a camada de abstração primeiro, mova o código do Asaas para dentro dela, e então adicione o novo gateway. Isso garante que o sistema continue funcionando durante a transição.

---

## 5. Implementação Cielo 3DS (Fevereiro 2026)

A integração com a Cielo foi realizada utilizando a camada de abstração `PaymentGatewayInterface` e o adaptador `CieloAdapter`. O foco principal foi a implementação da autenticação **3DS 2.0** para transações de débito.

### 5.1. Fluxo de Autenticação 3DS
1.  **Interceptação no Frontend:** O checkout identifica transações de `DEBIT_CARD` via Cielo e intercepta o `submit`.
2.  **Geração de Token OAuth:** O backend solicita um Access Token à Braspag/Cielo usando as credenciais `CIELO_CLIENTID` e `CIELO_CLIENTSECRET`.
3.  **Carregamento Dinâmico:** O script `BP.Mpi.3ds20.min.js` é carregado apenas sob demanda para evitar erros de inicialização prematura.
4.  **Desafio (Challenge):** O usuário realiza a autenticação no ambiente do banco emissor.
5.  **Captura de Dados:** Os tokens de sucesso (`Cavv`, `Xid`, `Eci`, `ReferenceId`) são capturados e enviados ao backend.

### 5.2. Regras de Segurança e Negócio
-   **Débito Obrigatório:** Transações de débito exigem autenticação 3DS com sucesso. Caso o cartão não seja elegível ou o desafio falhe, a transação é **bloqueada** automaticamente para proteger o lojista contra chargebacks.
-   **Limpeza de Dados:** O frontend realiza a limpeza de máscaras (espaços no número do cartão) antes de enviar para a Cielo, evitando erros de `Invalid enrollment request (400)`.
-   **Fallback de Endereço:** Implementado fallback para campos de endereço (Cidade/Estado) para garantir a fluidez do processo 3DS mesmo com dados parciais.

### 5.3. Variáveis de Ambiente Adicionadas
-   `CIELO_CLIENTID`: ID do cliente para OAuth.
-   `CIELO_CLIENTSECRET`: Secret do cliente para OAuth.
-   `CIELO_ESTABLISHMENT_CODE`: Código do estabelecimento na Cielo.
-   `CIELO_MERCHANT_NAME`: Nome da loja exibido na fatura/autenticação.
-   `CIELO_MCC`: Código de categoria do estabelecimento.
-   `GATEWAY_URL`: URL base da API Cielo (Sales).
-   `GATEWAY_QUERY_URL`: URL base da API Cielo (Consulta).
-   `GATEWAY_MERCHANT_ID`: ID do lojista na Cielo.
-   `GATEWAY_MERCHANT_KEY`: Chave do lojista na Cielo.
