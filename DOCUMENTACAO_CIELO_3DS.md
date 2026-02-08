# Documentação de Integração Cielo 3DS

Este documento centraliza as etapas e especificações para a integração com os serviços da Cielo, focando inicialmente na autenticação 3DS.

## Parte 1 - Obter Credenciais e Token de Acesso

### 1.1. Credenciais de Ambiente
As credenciais devem ser configuradas no arquivo `.env` do projeto.

**Ambiente Sandbox (Teste):**
```env
CIELO_CLIENTID=dba3a8db-fa54-40e0-8bab-7bfb9b6f2e2e
CIELO_CLIENTSECRET=D/ilRsfoqHlSUChwAMnlyKdDNd7FMsM7cU/vo02REag=
```

### 1.2. Criar o Token de Acesso (OAuth)
Para acessar os serviços que utilizam o Cielo OAuth, será necessário obter um `access_token`.

#### Fluxo de Autenticação:
1. Concatene o `ClientId` e o `ClientSecret` com dois pontos: `ClientId:ClientSecret`.
2. Codifique o resultado em **Base64**.
3. Utilize este valor no cabeçalho `Authorization` como `Basic {Base64}`.

#### Endpoints:
- **Sandbox:** `POST https://mpisandbox.braspag.com.br/v2/auth/token`
- **Produção:** `POST https://mpi.braspag.com.br/v2/auth/token`

#### Requisição (Body JSON):
```json
{
  "EstablishmentCode": "1006993069",
  "MerchantName": "Loja Exemplo Ltda",
  "MCC": "5912"
}
```

| Campo | Descrição | Tipo | Tamanho |
| :--- | :--- | :--- | :--- |
| **EstablishmentCode** | Código do Estabelecimento Cielo | Numérico | 10 posições |
| **MerchantName** | Nome do estabelecimento na adquirente | Alfanumérico | Até 25 posições |
| **MCC** | Merchant Category Code (CNAE) | Numérico | 4 posições |

#### Resposta de Sucesso:
```json
{
      "access_token": "eyJ0eXAiOiJKV1Qi...",
      "token_type": "bearer",
      "expires_in": "86399"
}
```

---

⚠️ **Atenção:**
- Para cada autenticação 3DS, é necessário obter e informar um **novo token de acesso**.
- Em testes via Postman, você pode inserir o ClientId e ClientSecret na aba "Auth" (Basic Auth) e ele fará o Base64 automaticamente.

## Parte 2 - Mapear as Classes HTML

A solução Cielo 3DS utiliza classes mapeadas em campos HTML para coletar dados automaticamente via script.

⚠️ **Atenção:**
- Quanto maior a quantidade de campos parametrizados, maior a chance de uma autenticação **sem desafio** (frictionless).
- O caractere `#` nos campos deve ser substituído pelo índice do item (ex: `bpmpi_item_1_productName`).
- **Amex:** Exige obrigatoriamente o campo `bpmpi_brand_establishment_code`.

### 2.1. Acesso e Tipo de Autenticação
| Campo | Descrição | Tipo/Tamanho | Obrigatório |
| :--- | :--- | :--- | :--- |
| `bpmpi_auth` | Indica se a transação será autenticada | Booleano (true/false) | Sim |
| `bpmpi_auth_notifyonly` | Modo "somente notificação" (Master/Visa) | Booleano | Condicional |
| `bpmpi_auth_suppresschallenge` | Ignorar desafio (liability com o lojista) | Booleano | Recomendado |
| `bpmpi_accesstoken` | Token gerado na Etapa 1 | Alfanumérico | Sim |

### 2.2. Dados do Pedido
| Campo | Descrição | Tipo/Tamanho | Obrigatório |
| :--- | :--- | :--- | :--- |
| `bpmpi_ordernumber` | Código do pedido na loja | Alfanumérico (50) | Sim |
| `bpmpi_currency` | Código da moeda | Fixo "BRL" | Sim |
| `bpmpi_totalamount` | Valor total em **centavos** | Numérico (15) | Sim |
| `bpmpi_installments` | Número de parcelas | Numérico (2) | Sim |
| `bpmpi_paymentmethod` | `Credit` ou `Debit` | Texto | Sim |
| `bpmpi_cardnumber` | Número do cartão | Numérico (19) | Sim |
| `bpmpi_cardexpirationmonth` | Mês de vencimento | Numérico (2) | Sim |
| `bpmpi_cardexpirationyear` | Ano de vencimento | Numérico (4) | Sim |
| `bpmpi_merchant_url` | URL do site (Sandbox usar `https://localhost`) | Alfanumérico (100) | Sim |

### 2.3. Endereço de Cobrança (Billing)
| Campo | Descrição | Tipo/Tamanho | Obrigatório |
| :--- | :--- | :--- | :--- |
| `bpmpi_billto_contactname` | Nome do contato | Alfanumérico (120) | Sim |
| `bpmpi_billto_phonenumber` | Telefone (ex: 5511999999999) | Numérico (15) | Sim |
| `bpmpi_billto_email` | E-mail | Alfanumérico (255) | Sim |
| `bpmpi_billto_street1` | Logradouro e Número | Alfanumérico (60) | Sim |
| `bpmpi_billto_city` | Cidade | Alfanumérico (50) | Sim |
| `bpmpi_billto_state` | Sigla do Estado (2 posições) | Texto (2) | Sim |
| `bpmpi_billto_zipcode` | CEP (apenas números) | Alfanumérico (8) | Sim |
| `bpmpi_billto_country` | País (Ex: BR) | Texto (2) | Sim |

### 2.4. Dispositivo
| Campo | Descrição | Tipo/Tamanho | Obrigatório |
| :--- | :--- | :--- | :--- |
| `bpmpi_device_ipaddress` | IP do comprador | Alfanumérico (45) | Sim |
| `bpmpi_device_channel` | `Browser`, `SDK` ou `3RI` | Alfanumérico (7) | Sim |

### 2.5. Outros Campos (Recomendados)
- **Características do Pedido:** `bpmpi_order_productcode` (Obrigatório: PHY, CHA, ACF, QCT, PAL).
- **Entrega (ShipTo):** `bpmpi_shipto_sameasbillto`, `bpmpi_shipto_zipcode`, etc.
- **Carrinho:** `bpmpi_cart_#_name`, `bpmpi_cart_#_quantity`, `bpmpi_cart_#_unitprice`.
- **Usuário:** `bpmpi_useraccount_guest`, `bpmpi_useraccount_createddate`.
- **Recorrência:** `bpmpi_recurring_type`, `bpmpi_recurring_frequency`.

---

## Parte 3 - Implementar o Script e Eventos

Nesta etapa, você deve incluir o script da Cielo no seu checkout e configurar os eventos de retorno.

### 3.1. Exemplo de Implementação Básica (HTML)

```html
<html>
  <head>
    <script type="text/javascript">
      function sendOrder() {
        bpmpi_authenticate(); // Inicia o processo de autenticação
      }
    </script>
  </head>
  <body>
    <!-- Campos obrigatórios mapeados via classe -->
    <input type="hidden" class="bpmpi_auth" value="true" />
    <input type="hidden" class="bpmpi_accesstoken" value="TOKEN_GERADO_NA_ETAPA_1" />
    
    <input type="text" class="bpmpi_ordernumber" value="123456" />
    <input type="text" class="bpmpi_totalamount" value="1000" /> <!-- 10,00 -->
    
    <input type="button" onclick="sendOrder()" value="Finalizar" id="btnSendOrder" disabled />
  </body>

  <script type="text/javascript">
    function bpmpi_config() {
      return {
        onReady: function () {
          // Script carregado e pronto
          document.getElementById("btnSendOrder").disabled = false;
        },
        onSuccess: function (e) {
          // Autenticado com sucesso. Enviar Cavv, Xid e Eci para sua API de Autorização.
          console.log("Sucesso:", e.Cavv, e.Eci, e.ReferenceId);
        },
        onFailure: function (e) {
          // Falha na autenticação. Risco de chargeback do lojista se prosseguir.
          console.log("Falha:", e.Eci, e.ReturnMessage);
        },
        onUnenrolled: function (e) {
          // Cartão não participa do programa 3DS.
          console.log("Não Elegível:", e.Eci);
        },
        onError: function (e) {
          // Erro sistêmico no processo.
          console.log("Erro:", e.ReturnCode, e.ReturnMessage);
        },
        Environment: "SDB", // "SDB" para Sandbox ou "PRD" para Produção
        Debug: true
      };
    }
  </script>
  
  <!-- URL do Script (Alterar conforme o ambiente) -->
  <!-- Sandbox: https://mpisandbox.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js -->
  <!-- Produção: https://mpi.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js -->
  <script src="https://mpisandbox.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js" type="text/javascript"></script>
</html>
```

### 3.2. Configuração de Ambientes
| Ambiente | Valor `Environment` | URL do Script (`src`) |
| :--- | :--- | :--- |
| **Sandbox** | `"SDB"` | `https://mpisandbox.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js` |
| **Produção** | `"PRD"` | `https://mpi.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js` |

### 3.3. Descrição dos Eventos
| Evento | Descrição |
| :--- | :--- |
| **onReady** | Script carregado e token validado. Checkout pronto para autenticar. |
| **onSuccess** | Cartão elegível e autenticado. **Liability shift para o emissor.** |
| **onFailure** | Cartão elegível, mas autenticação falhou. **Risco do lojista.** |
| **onUnenrolled** | Cartão/Emissor não participam do 3DS. **Risco do lojista.** |
| **onError** | Erro sistêmico. **Risco do lojista.** |

### 3.4. Parâmetros de Saída (Para Autorização)
Estes valores retornados nos eventos devem ser capturados e enviados na sua requisição de **Autorização de Pagamento**:

- **Cavv:** Assinatura da autenticação.
- **Xid:** ID da requisição de autenticação.
- **Eci:** Indicador do e-commerce (resultado da análise).
- **ReferenceID:** ID único da transação no 3DS.

---

## Parte 4 - Execução e Tabela de Resultados (ECI)

### 4.1. Chamada do Evento de Autenticação
O método `bpmpi_authenticate()` deve ser acionado no momento exato em que o usuário clica para finalizar a compra no checkout.

```html
<!-- Exemplo de botão para disparar a autenticação -->
<input type="button" value="Finalizar Compra" onclick="bpmpi_authenticate()" />
```

### 4.2. Tabela de ECI (Electronic Commerce Indicator)
O ECI é o código que define o resultado da autenticação e, consequentemente, quem assume o risco de fraude (Chargeback).

| Mastercard | Visa | Elo | Amex | Resultado da Autenticação | Autenticada? | Risco (Liability) |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **02** | **05** | **05** | **05** | Autenticada pelo emissor | Sim | **Emissor** |
| **01** | **06** | **06** | **06** | Autenticada pela bandeira | Sim | **Emissor** |
| Outros | Outros | Outros | Outros | Não autenticada | Não | **Estabelecimento** |
| **04** | **07** | - | - | Data Only | Não | **Estabelecimento** |

---

⚠️ **Atenção:**
- Após obter o ECI via script, você deve enviá-lo na requisição de autorização (API Cielo) no campo: `Payment.ExternalAuthentication.Eci`.
- Transações com ECI de "Não autenticada" ou "Data Only" podem ser processadas, mas o estabelecimento assume total responsabilidade por possíveis chargebacks.

---

## Parte 5 - Códigos de Retorno 3DS (Return Codes)

Estes códigos são retornados como resposta à execução do script e também podem aparecer após a tentativa de autorização.

| Reason Code | Descrição | Ação Recomendada |
| :--- | :--- | :--- |
| **100** | Transação realizada com sucesso. | Prosseguir com o fluxo. |
| **101** | Campos obrigatórios ausentes. | Verificar campos `missingField_N` e reenviar. |
| **102** | Dados inválidos em um ou mais campos. | Verificar campos `invalidField_N` e corrigir. |
| **150** | Falha geral no sistema. | Aguardar alguns minutos e tentar novamente. |
| **151** | Time-out do servidor (interno). | Aguardar alguns minutos e tentar novamente. |
| **152** | Time-out de serviço. | Aguardar alguns minutos e tentar novamente. |
| **234** | Problema na configuração do Merchant. | **Não reenviar.** Contatar o suporte Braspag/Cielo. |
| **475** | Autenticação do pagante requerida. | Realizar a autenticação 3DS antes de prosseguir. |
| **476** | Cliente não pode ser autenticado. | Revisar os dados do pedido do cliente. |
| **MPI901** | Erro inesperado. | Investigar logs ou contatar suporte. |
| **MPI902** | Resposta inesperada da autenticação. | Investigar logs. |
| **MPI900** | Ocorreu um erro genérico. | Investigar logs. |
| **MPI601** | Desafio omitido. | Verificar regras de frictionless/desafio. |
| **MPI600** | Bandeira não suporta autenticação. | Prosseguir sem 3DS (risco do lojista). |

---

⚠️ **Importante:**
- O valor do **ECI** é o que define quem assume o risco de chargeback.
- Para testes em Sandbox, a `bpmpi_merchant_url` deve ser `https://localhost`.

---

## Parte 6 - Pagamento Recorrente Programado

Esta etapa descreve como criar a transação inicial de uma recorrência na API da Cielo, integrando os dados obtidos na autenticação 3DS.

### 6.1. Endpoints de Venda (Sales)
| Ambiente | Método | Endpoint |
| :--- | :--- | :--- |
| **Sandbox** | `POST` | `https://apisandbox.cieloecommerce.cielo.com.br/1/sales/` |
| **Produção** | `POST` | `https://api.cieloecommerce.cielo.com.br/1/sales/` |

### 6.2. Configuração da Recorrência
Para a **Recorrência Programada**, é necessário enviar o nó `RecurrentPayment` no objeto `Payment`.

**Parâmetros principais:**
- `AuthorizeNow`: `true` (Define que a primeira recorrência será autorizada imediatamente).
- `Interval`: Intervalo da recorrência (Monthly, Bimonthly, etc).
- `EndDate`: Data de término (AAAA-MM-DD).

### 6.3. Integrando o 3DS na Recorrência (Débito ou Crédito)
Ao criar a primeira transação da recorrência, você deve enviar os dados capturados pelo script 3DS no objeto `ExternalAuthentication`:

```json
{
  "MerchantOrderId": "2026020501",
  "Customer": { "Name": "Comprador de Teste" },
  "Payment": {
    "Type": "CreditCard", // Ou "DebitCard"
    "Amount": 1000,
    "Installments": 1,
    "RecurrentPayment": {
        "AuthorizeNow": true,
        "Interval": "Monthly",
        "EndDate": "2027-02-05"
    },
    "ExternalAuthentication": {
        "Cavv": "VALOR_RETORNADO_PELO_SCRIPT",
        "Xid": "VALOR_RETORNADO_PELO_SCRIPT",
        "Eci": "VALOR_RETORNADO_PELO_SCRIPT",
        "ReferenceId": "VALOR_RETORNADO_PELO_SCRIPT"
    },
    "CreditCard": {
        "CardNumber": "4000000000000001",
        "Holder": "Nome no Cartão",
        "ExpirationDate": "12/2030",
        "SecurityCode": "123",
        "Brand": "Visa"
    }
  }
}
```

### 6.4. Exemplo Real: Débito Recorrente (JSON)
Este é o formato de body validado para criação de assinatura via débito:

```json
{
 "MerchantOrderId": "559042025",
 "Customer": {
   "Name": "Fulano da Silva",
   "Identity":"11225468954",
   "IdentityType":"CPF"
 },
 "Payment": {
    "Type": "DebitCard",
    "Amount": 13000,
   "Authenticate": true,
   "Recurrent": true,
   "RecurrentPayment": {
     "AuthorizeNow": true,
     "Interval": "Monthly"
   },
   "DebitCard": {
     "CardNumber": "4024007197692931",
     "Holder": "Teste Holder",
     "ExpirationDate": "12/2030",
     "SecurityCode": "123",
     "SaveCard": true,
     "Brand": "Elo"
   },
   "SoftDescriptor": "NOME_NA_FATURA",
   "Currency": "BRL",
   "Country": "BRA"
 }
}
```

### 6.5. Retorno da Recorrência
A Cielo retornará campos específicos que devem ser armazenados para as cobranças futuras:
- **RecurrentPaymentId:** GUID que identifica a assinatura.
- **NextRecurrency:** Data da próxima cobrança.
- **PaymentId:** ID da transação atual.

### 6.5. Orientações para Sandbox
- **Cartões:** Utilize finais `0`, `1` ou `4`.
- **Luhn:** O cartão deve ser válido no algoritmo Mod10 para permitir a tokenização.
- **MerchantId/Key:** Utilize as credenciais de Sandbox fornecidas na documentação ou no seu `.env`.

---

⚠️ **Nota sobre Débito Recorrente:**
Diferente do crédito, o débito recorrente via 3DS exige que a **primeira transação** seja autenticada com sucesso. As recorrências seguintes são processadas pela Cielo utilizando o `RecurrentPaymentId`, sem necessidade de nova intervenção do usuário.
