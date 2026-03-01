# Criar pagamento de cartão de débito

**post**  
https://apisandbox.braspag.com.br/v2/sales/

Cria uma transação de débito

---

## Ambiente

| Ambiente  | Método | Endpoint                                         |
|-----------|--------|--------------------------------------------------|
| Sandbox   | post   | https://apisandbox.braspag.com.br/v2/sales/      |
| Produção  | post   | https://api.braspag.com.br/v2/sales/             |

ℹ️  
Saiba mais sobre essa funcionalidade na documentação.

Para o ambiente sandbox, use o valor **"Simulado"** no campo `Payment.Provider`.

---

⚠️  
## Identificação de transações oriundas de link de pagamento para cartões da bandeira Elo

A partir de 17 de outubro de 2025 será obrigatório identificar transações oriundas de link de pagamento para cartões da bandeira Elo. Envie o parâmetro `Payment.SolutionType = "ExternalLinkPay"`.

---

# Autenticação 3DS nas transações de cartão de débito

A autenticação 3DS é obrigatória para as transações de débito.

Na transação de débito padrão (com autenticação), envie `Authenticate = "true"`;  
Informe os dados recebidos na saída do script no nó `Payment.ExternalAuthentication`;  
Em transações com autenticação 3DS Data Only, é necessário informar o parâmetro `ExternalAuthentication.DataOnly` como true.

Para confirmar se a autenticação foi acatada na autorização, verifique o valor do ECI retornado em `Payment.Eci`. A API replica o ECI informado pela loja no campo `Payment.ExternalAuthentication`. No entanto, o valor efetivamente utilizado pela bandeira na autorização é o que aparece em `Payment.Eci`.

ℹ️  
**Importante**  
A validação e o retorno do campo `Payment.Eci` ocorrem apenas no ambiente de produção neste primeiro momento.

---

# Resposta da transação de cartão de débito

A tabela a seguir apresenta os principais parâmetros que podem ser retornados pela API na criação de um pagamento com cartão de débito.

| Propriedade | Descrição | Tipo | Tamanho |
|-------------|-----------|------|----------|
| AcquirerTransactionId | Id da transação no provedor de meio de pagamento. | string | 40 |
| ProofOfSale | Número do comprovante de venda. | string | 20 |
| SentOrderId | Indica qual número de pedido foi enviado à adquirente.<br><br>Se o número informado estiver em formato inválido, a adquirente gerará um novo identificador, retornado no campo SentOrderId.<br>Se o formato for válido e aceito pela adquirente, o campo SentOrderId conterá o mesmo valor informado em MerchantOrderId. | GUID |  |
| AuthorizationCode | Código de autorização. | string | 300 |
| PaymentId | Campo identificador do pagamento. O PaymentId será usado em futuras operações como consulta, captura e cancelamento. | GUID | 36 |
| ReceivedDate | Data em que a transação foi recebida pela Cielo. | string | 19 |
| ReasonCode | Código de retorno da API para indicar sucesso ou erro na operação. | string | 32 |
| ReasonMessage | Mensagem correspondente ao ReasonCode. | string | 512 |
| Status | Status da transação. Veja a lista completa de Status da Transação. | byte | 2 |
| ProviderReturnCode | Código retornado pelo provedor do meio de pagamento (adquirente ou emissor). | string | 32 |
| ProviderReturnMessage | Mensagem retornada pelo provedor do meio de pagamento (adquirente ou emissor). | string | 512 |
| Payment.MerchantAdviceCode | Código de retorno da bandeira que define período para retentativa. Válido para bandeira Mastercard. | string | 2 |
| Payment.ExternalAuthentication.Cavv | Valor Cavv submetido na requisição de autorização. | string | 28 |
| Payment.ExternalAuthentication.Xid | Valor Xid submetido na requisição de autorização. | string | 28 |
| Payment.ExternalAuthentication.Eci | Valor Eci submetido na requisição de autorização. | integer | 1 |
| Payment.ExternalAuthentication.Version | Versão do 3DS utilizado no processo de autenticação. | string | 1 |
| Payment.ExternalAuthentication.ReferenceId | RequestID retornado no processo de autenticação. | GUID | 36 |

---

# Body Params

## MerchantOrderId
- **string**
- **obrigatório**
- Número de identificação do pedido.  
  Atenção: Os caracteres permitidos são apenas a-z, A-Z, 0-9. Não são permitidos caracteres especiais e espaços em branco.  
  Tamanho: 50.

---

## Customer (object)

### Name
- **string**
- Nome do comprador. Tamanho: 255.  
  Atenção: Os caracteres permitidos são apenas a-z, A-Z. Não são permitidos caracteres especiais e números.

### Identity
- **string**
- Número do CPF ou CNPJ do cliente. Tamanho: 14.

### IdentityType
- **string**
- Tipo de documento de identificação do comprador (CPF ou CNPJ). Tamanho: 255.

### Email
- **string**
- Email do comprador. Tamanho: 255.

### Birthdate
- **date**
- Data de nascimento do comprador no formato AAAA-MM-DD. Tamanho: 10.

### IpAddress
- **string**
- Endereço de IP do comprador. Suporte a IPv4 e IPv6. Tamanho: 45.

---

## Address (object)

### Street
- **string**
- Endereço de contato do comprador. Tamanho: 255.

### Number
- **string**
- Número do endereço de contato do comprador. Tamanho: 15.

### Complement
- **string**
- Complemento do endereço de contato do comprador. Tamanho: 50.

### ZipCode
- **string**
- CEP do endereço de contato do comprador. Tamanho: 9.

### City
- **string**
- Cidade do endereço de contato do comprador. Tamanho: 50.

### State
- **string**
- Estado do endereço de contato do comprador. Tamanho: 2.

### Country
- **string**
- País do endereço de contato do comprador. Tamanho: 35.

### District
- **string**
- Bairro do endereço de contato do comprador. Tamanho: 50.

---

## DeliveryAddress (object)

### Street
- **string**
- Endereço de entrega do comprador. Tamanho: 255.

### Number
- **string**
- Número do endereço de entrega. Tamanho: 15.

### Complement
- **string**
- Complemento do endereço de entrega. Tamanho: 50.

### ZipCode
- **string**
- CEP do endereço de entrega. Tamanho: 9.

### City
- **string**
- Cidade do endereço de entrega. Tamanho: 50.

### State
- **string**
- Estado do endereço de entrega. Tamanho: 2.

### Country
- **string**
- País do endereço de entrega. Tamanho: 35.

### District
- **string**
- Bairro do endereço de entrega. Tamanho: 50.

---

## Payment (object)

### Provider
- **string**
- **obrigatório**
- Nome do provedor do meio de pagamento. Clique aqui para acessar a lista de provedores.  
  Obs.: Atualmente somente a Cielo suporta esta forma de pagamento via Pagador.  
  Tamanho: 15.

### Type
- **string**
- **obrigatório**
- Tipo do meio de pagamento. Neste caso, “DebitCard”.  
  Tamanho: 100.

### Amount
- **int32**
- **obrigatório**
- Valor do pedido, em centavos.  
  Tamanho: 15.

### Installments
- **int32**
- Número de parcelas. Tamanho: 2.

### ReturnUrl
- **string**
- **obrigatório**
- URL para onde o usuário será redirecionado após o fim do pagamento.  
  Tamanho: 1024.

### Tip
- **boolean**
- As gorjetas são um tipo de transação que funcionam para cartão de crédito ou débito, tokenizados ou não.  
  Se o valor for true, a transação é identificada como gorjeta, caso contrário, o valor deverá ser false.

### SolutionType
- **string**
- Origem do pagamento. Obrigatório para transação de cartão da bandeira Elo oriunda de link de pagamento.  
  Enviar como "ExternalLinkPay".  
  Tamanho: 15.

---

## DebitCard (object)

### Authenticate
- **boolean**
- **obrigatório**
- Define se o comprador será direcionado ao emissor para autenticação do cartão.  
  Sim, caso a autenticação seja validada.


true


---

## ExternalAuthentication (object)

### Cavv
- **string**
- **obrigatório**
- Assinatura retornada nos cenários de sucesso na autenticação.  
⚠️ Este campo é obrigatório para transações que foram autenticadas pelo emissor ou pela bandeira e nas solicitações de autorizações com Data Only.

### Xid
- **string**
- **obrigatório**
- XID retornado no processo de autenticação.  
  - O Xid não é retornado em todas as autenticações.  
  - O envio é recomendado caso o Xid tenha sido retornado no script.

### Eci
- **int32**
- **obrigatório**
- Electronic Commerce Indicator retornado no processo de autenticação.  
  Tamanho: 1.

### Version
- **string**
- **obrigatório**
- Campo obrigatório para transações com autenticação 3DS.  
  Versão do 3DS aplicado no processo de autenticação.  
  Valores possíveis:
  - Visa e Mastercard: "2.2.0"
  - Elo e Amex: "2.1.0"  
  Tamanho: 5.

### ReferenceId
- **string**
- **obrigatório**
- RequestID retornado no processo de autenticação.  
  - O ReferenceId não é retornado em todas as autenticações.  
  - O envio é recomendado caso o ReferenceId tenha sido retornado no script.  
  Tamanho: 36.

### DataOnly
- **boolean**
- Define se é uma transação com autenticação 3DS do tipo Data Only.  
  O envio é obrigatório no caso de transação Data Only.

---

## InitiatedTransactionIndicator (object)

### Category
- **string**
- **Obrigatório para as bandeiras Mastercard**
- Categoria do indicador de início da transação. Válido apenas para bandeira Mastercard.  
  Valores possíveis:
  - “C1”: transação inciada pelo portador do cartão;
  - “M1”: transação recorrente ou parcelada iniciada pela loja;
  - “M2”: transação iniciada pela loja.  
  Tamanho: 2.

### Subcategory
- **string**
- Obrigatório para as bandeiras Mastercard. Subcategoria do indicador.  
  Válido apenas para bandeira Mastercard.  
  Valores possíveis:

Se `InitiatedTransactionIndicator.Category = "C1"` ou `"M1"`  
- CredentialsOnFile  
- StandingOrder  
- Subscription  
- Installment  

Se `InitiatedTransactionIndicator.Category = "M2"`  
- PartialShipment  
- RelatedOrDelayedCharge  
- NoShow  
- Resubmission  

Consulte a tabela com a descrição das subcategorias em Indicador de Início da Transação.

---

# Headers

## Content-Type
- **string**
- **obrigatório**
- Defaults to application/json


application/json


---

## MerchantId
- **string**
- **obrigatório**
- Defaults to e3c24810-18bb-4bd7-88a0-a36d6b4a0731  
- Identificador da loja no Gateway de Pagamento. Tamanho: 36. Formato: GUID.

Esta documentação traz um MerchantId padrão para permitir os testes em sandbox, mas você também pode informar o MerchantId habilitado durante o processo de implantação.


e3c24810-18bb-4bd7-88a0-a36d6b4a0731


---

## MerchantKey
- **string**
- **obrigatório**
- Defaults to GQUAIWVDKUINZRHDQPLHUVHAIIFEIXFEXWPOYGHY  
- Chave pública para autenticação dupla no Gateway de Pagamento. Tamanho: 40. Formato: GUID.

Esta documentação traz um MerchantKey padrão para permitir os testes em sandbox, mas você também pode informar o MerchantKey habilitado durante o processo de implantação.


GQUAIWVDKUINZRHDQPLHUVHAIIFEIXFEXWPOYGHY


---

## RequestId
- **string**
- Identificador do request definido pela loja, utilizado quando o lojista usa diferentes servidores para cada GET/POST/PUT.  
  Tamanho: 36.

---

# Response

## 201
201