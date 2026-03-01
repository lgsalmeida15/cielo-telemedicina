# Criar pagamento com cartão de crédito

**post**  
https://apisandbox.braspag.com.br/v2/sales/

Cria uma transação de cartão de crédito

---

## Ambiente

| Ambiente  | Método | Endpoint                                         |
|-----------|--------|--------------------------------------------------|
| Sandbox   | post   | https://apisandbox.braspag.com.br/v2/sales/      |
| Produção  | post   | https://api.braspag.com.br/v2/sales/             |

ℹ️  
Saiba mais sobre essa funcionalidade na documentação.

---

## Atenção

- Se as suas transações forem uma chamada conjunta com o Antifraude, os tamanhos de campos podem ser diferentes. Consulte o tópico Pagamento com Análise de Fraude;

- O campo `Payment.ServiceTaxAmount` é exclusivo para companhias aéreas e agências de turismo. Para as companhias aéreas, permite a cobrança da taxa de embarque separadamente do valor da passagem aérea. Já para as agências de turismo, é utilizado especialmente para a cobrança de taxas na primeira parcela;

- As bandeiras JCB e Diners são estrangeiras e não permitem parcelamento no cartão de crédito;

- Os parâmetros contidos dentro dos nós `Address` e `DeliveryAddress` são de preenchimento obrigatório quando a transação é submetida ao Antifraude ou à análise do Velocity;

- O número de identificação do pedido (`MerchantOrderId`) não sofre alteração ao longo do fluxo transacional. Contudo, um novo número (`SentOrderId`) pode ser gerado para o pedido e utilizado durante a transação. Esse número só será diferente se:
  - o `MerchantOrderID` enviado estiver fora das especificações descritas no campo;
  - o `MerchantOrderID` enviado já foi utilizado nas últimas 24 horas.

⚠️  
**Identificação de transações oriundas de link de pagamento para cartões da bandeira Elo**

A partir de 17 de outubro de 2025 será obrigatório identificar transações oriundas de link de pagamento para cartões da bandeira Elo. Envie o parâmetro `Payment.SolutionType = "ExternalLinkPay"`.

---

## Autenticação 3DS nas transações de cartão de crédito

A autenticação 3DS é opcional para as transações de cartão crédito.

Se a sua loja tem integração com o protocolo 3DS para autenticação do portador do cartão, atente-se aos parâmetros que devem ser informados na requisição:

- Envie o parâmetro `Payment.Authenticate = "true"`;
- Informe os dados recebidos na saída do script do 3DS no nó `Payment.ExternalAuthentication`;
- Em transações com autenticação 3DS Data Only, informe o parâmetro `ExternalAuthentication.DataOnly` como true.

Para confirmar se a autenticação foi acatada na autorização, verifique o valor do ECI retornado em `Payment.Eci`. A API replica o ECI informado pela loja no campo `Payment.ExternalAuthentication`. No entanto, o valor efetivamente utilizado pela bandeira na autorização é o que aparece em `Payment.Eci`.

ℹ️  
**Importante**  
A validação e o retorno do campo `Payment.Eci` ocorrem apenas no ambiente de produção neste primeiro momento.

---

## Visa Intelligent Data Exchange (IDX)

Caso use o serviço de autenticação IDX da Visa, veja Visa Intelligent Data Exchange (IDX)

---

# Resposta da transação de cartão de crédito

A tabela a seguir apresenta os principais parâmetros que podem ser retornados pela API na criação de um pagamento com cartão de crédito.

| Propriedade | Descrição | Tipo | Tamanho |
|-------------|-----------|------|----------|
| AcquirerTransactionId | Id da transação no provedor de meio de pagamento. | string | 40 |
| ProofOfSale | Número do comprovante de venda, idêntico ao NSU (Número Sequencial Único). | string | 20 |
| AuthorizationCode | Código de autorização. | string | 300 |
| SentOrderId | Indica qual número de pedido foi enviado à adquirente.<br><br>Se o número informado estiver em formato inválido, a adquirente gerará um novo identificador, retornado no campo SentOrderId.<br>Se o formato for válido e aceito pela adquirente, o campo SentOrderId conterá o mesmo valor informado em MerchantOrderId. | GUID |  |
| PaymentId | Campo identificador do pagamento. O PaymentId será usado em futuras operações como consulta, captura e cancelamento. | string | 36 |
| ReceivedDate | Data em que a transação foi recebida pela Cielo. | datetime | 19 |
| CapturedDate | Data em que a transação foi capturada. | string | 19 |
| CapturedAmount | Valor capturado, sem pontuação. | integer | 15 |
| ECI | Electronic Commerce Indicator. Representa o resultado da autenticação. | string | 2 |
| ReasonCode | Código de retorno da API para indicar sucesso ou erro na operação. | string | 32 |
| ReasonMessage | Mensagem correspondente ao ReasonCode. | string | 512 |
| Status | Status da transação. Veja a lista completa de Status da Transação. | byte | 2 |
| ProviderReturnCode | Código retornado pelo provedor do meio de pagamento (adquirente ou emissor). | string | 32 |
| ProviderReturnMessage | Mensagem retornada pelo provedor do meio de pagamento (adquirente ou emissor). | string | 512 |
| Payment.MerchantAdviceCode | Código de retorno da bandeira que define período para retentativa. Válido para bandeira Mastercard. Saiba mais em Programa de Retentativa das Bandeiras | string | 2 |
| BrandTransactionId | Identificador de transações recorrentes junto às bandeiras na adquirente Rede. Exclusivo Rede. | string | 21 |

---

# Body Params

### MerchantOrderId
- **string**
- **obrigatório**
- Número de identificação do pedido. Tamanho: 50.

### Customer
- **object**
- Customer object

### Payment
- **object**
- Payment object

---

# Headers

### Content-Type
- **string**
- **obrigatório**
- Defaults to application/json


application/json


---

### MerchantId
- **string**
- **obrigatório**
- Defaults to e3c24810-18bb-4bd7-88a0-a36d6b4a0731
- Identificador da loja no Gateway de Pagamento. Tamanho: 36. Formato: GUID.

Esta documentação traz um MerchantId padrão para permitir os testes em sandbox, mas você também pode informar o MerchantId habilitado durante o processo de implantação.


e3c24810-18bb-4bd7-88a0-a36d6b4a0731


---

### MerchantKey
- **string**
- **obrigatório**
- Defaults to GQUAIWVDKUINZRHDQPLHUVHAIIFEIXFEXWPOYGHY
- Chave pública para autenticação dupla no Gateway de Pagamento. Tamanho: 40. Formato: GUID.

Esta documentação traz um MerchantKey padrão para permitir os testes em sandbox, mas você também pode informar o MerchantKey habilitado durante o processo de implantação.


GQUAIWVDKUINZRHDQPLHUVHAIIFEIXFEXWPOYGHY


---

### RequestId
- **string**
- Identificador do request definido pela loja, utilizado quando o lojista usa diferentes servidores para cada GET/POST/PUT. Tamanho: 36.

---

# Response

## 201
201