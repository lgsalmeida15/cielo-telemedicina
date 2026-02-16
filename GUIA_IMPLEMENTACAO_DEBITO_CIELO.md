# Guia de Implementação: Pagamento com Cartão de Débito (Cielo/Braspag)

Este documento descreve os requisitos e a estrutura para a implementação de transações de débito utilizando a API da Cielo/Braspag.

## 1. Endpoints e Ambientes

| Ambiente | Método | Endpoint |
| :--- | :--- | :--- |
| **Sandbox** | `POST` | `https://apisandbox.braspag.com.br/v2/sales/` |
| **Produção** | `POST` | `https://api.braspag.com.br/v2/sales/` |

> ℹ️ **Importante (Sandbox):** Utilize o valor `"Simulado"` no campo `Payment.Provider` para testes.

## 2. Cabeçalhos (Headers) Obrigatórios

| Header | Valor / Exemplo | Descrição |
| :--- | :--- | :--- |
| `Content-Type` | `application/json` | Tipo de conteúdo da requisição. |
| `MerchantId` | `e3c24810-18bb-4bd7-88a0-a36d6b4a0731` | Identificador da loja (GUID). |
| `MerchantKey` | `GQUAIWVDKUINZRHDQPLHUVHAIIFEIXFEXWPOYGHY` | Chave pública de autenticação. |
| `RequestId` | `GUID` (Opcional) | Identificador único da requisição para rastreabilidade. |

## 3. Autenticação 3DS (Obrigatória para Débito)

A autenticação 3DS é mandatória para transações de débito.

- **Authenticate:** Deve ser enviado como `"true"`.
- **ExternalAuthentication:** Se a autenticação for feita externamente, envie os dados no nó `Payment.ExternalAuthentication`.
- **Data Only:** Para transações 3DS Data Only, informe `ExternalAuthentication.DataOnly = true`.
- **ECI:** Verifique o valor retornado em `Payment.Eci` para confirmar se a autenticação foi acatada.

## 4. Regras Específicas (Bandeira Elo)

⚠️ **A partir de 17/10/2025:** Para transações oriundas de **links de pagamento** com a bandeira **Elo**, é obrigatório enviar:
- `Payment.SolutionType = "ExternalLinkPay"`

## 5. Estrutura do Body (JSON) - Principais Campos

```json
{
  "MerchantOrderId": "2026021501",
  "Customer": {
    "Name": "Nome do Comprador",
    "Identity": "12345678909",
    "IdentityType": "CPF",
    "Email": "comprador@exemplo.com",
    "Birthdate": "1990-01-01",
    "IpAddress": "127.0.0.1"
  },
  "Payment": {
    "Provider": "Simulado",
    "Type": "DebitCard",
    "Amount": 10000,
    "Installments": 1,
    "ReturnUrl": "https://sualoja.com.br/retorno",
    "Authenticate": true,
    "SolutionType": "ExternalLinkPay",
    "DebitCard": {
      "CardNumber": "0000000000000001",
      "Holder": "Nome no Cartao",
      "ExpirationDate": "12/2030",
      "SecurityCode": "123",
      "Brand": "Visa"
    }
  }
}
```

## 6. Resposta da Transação (Response)

Campos importantes para monitorar:

- `PaymentId`: Identificador único do pagamento (usar para consultas/estornos).
- `Status`: Status da transação (1 = Autorizado, 2 = Pago).
- `ReasonCode` / `ReasonMessage`: Detalhes de sucesso ou erro.
- `ProviderReturnCode`: Código de retorno direto do emissor/adquirente.
- `AuthenticationUrl`: URL para redirecionar o cliente caso o 3DS exija desafio (challenge).

## 7. Dicas de Implementação no Laravel

1. **Gere o MerchantOrderId:** Use um padrão alfanumérico sem espaços (ex: `date('YmdHis') . $userId`).
2. **Tratamento de Erros:** Sempre valide o `ReasonCode` antes de confirmar o pedido no seu banco de dados.
3. **Logs:** Salve o `RequestId` e o `PaymentId` em seus logs de transação para facilitar o suporte com a Cielo.
