# Cancelar transação de cartão de crédito

**PUT**  
`https://apisandbox.braspag.com.br/v2/sales/{PaymentId}/void`

Cancela ou estorna uma transação de cartão de crédito.

---

## Ambiente

| Ambiente   | Método | Endpoint |
|------------|--------|----------|
| Sandbox    | PUT    | https://apisandbox.braspag.com.br/v2/sales/{PaymentId}/void |
| Produção   | PUT    | https://api.braspag.com.br/v2/sales/{PaymentId}/void |

---

## Cancelamento total

Para cancelar totalmente uma transação, **não é necessário enviar o campo `Amount`**.

---

## Cancelamento parcial

| Ambiente   | Método | Endpoint |
|------------|--------|----------|
| Sandbox    | PUT    | https://apisandbox.braspag.com.br/v2/sales/{PaymentId}/void?amount={Amount} |
| Produção   | PUT    | https://api.braspag.com.br/v2/sales/{PaymentId}/void?amount={Amount} |

Para cancelar parcialmente uma transação, envie no campo `Amount` o valor em **centavos** que deseja cancelar.

---

⚠️ **Importante**

Não é possível estornar parcialmente uma transação não capturada.  

Para fazer um cancelamento parcial, o campo `Capture` deve ser `"true"` na criação do pagamento com cartão de crédito.

---

## Cancelamento em lote

A API permite cancelar transações individualmente.

Para cancelar um grupo de transações, utilize o portal e-commerce. Saiba mais em:

- Como cancelar transações em lote (até 23h59 do dia da criação da transação);
- Como estornar transações em lote (a partir do dia seguinte à criação da transação).

---

# Parâmetros

## Path Params

### `PaymentId`
- **Tipo:** string  
- **Obrigatório:** Sim  
- **Descrição:** Campo identificador do pedido.  
- **Tamanho:** 36  

---

## Query Params

### `Amount`
- **Tipo:** int32  
- **Descrição:** Valor, em centavos, a ser cancelado/estornado.  
- **Tamanho:** 15  

**Observações:**
1. Verifique se a adquirente contratada suporta a operação de cancelamento ou estorno.
2. Caso o valor de `Amount` seja informado como “0” (zero), ou esse parâmetro não seja enviado, será considerado um estorno total do valor capturado.

---

# Headers

### `Content-Type`
- **Tipo:** string  
- **Default:** `application/json`  

---

### `MerchantId`
- **Tipo:** string  
- **Obrigatório:** Sim  
- **Default:** `e3c24810-18bb-4bd7-88a0-a36d6b4a0731`  
- **Descrição:** Identificador da loja no Gateway de Pagamento.  
- **Tamanho:** 36  
- **Formato:** GUID  

Esta documentação traz um `MerchantId` padrão para permitir os testes em sandbox, mas você também pode informar o `MerchantId` habilitado durante o processo de implantação.

---

### `MerchantKey`
- **Tipo:** string  
- **Obrigatório:** Sim  
- **Default:** `GQUAIWVDKUINZRHDQPLHUVHAIIFEIXFEXWPOYGHY`  
- **Descrição:** Chave pública para autenticação dupla no Gateway de Pagamento.  
- **Tamanho:** 40  
- **Formato:** GUID  

Esta documentação traz um `MerchantKey` padrão para permitir os testes em sandbox, mas você também pode informar o `MerchantKey` habilitado durante o processo de implantação.

---

### `RequestId`
- **Tipo:** string  
- **Descrição:** Identificador do request definido pela loja, utilizado quando o lojista usa diferentes servidores para cada GET/POST/PUT.  
- **Tamanho:** 36  

---

# Response

## 200
- 200


