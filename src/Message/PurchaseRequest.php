<?php

namespace Omnipay\Gkash\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {

        $this->guardParameters();

        return [
            // required
            'version' => $this->getVersion(),
            'CID' => $this->getCID(),
            'v_cartid' => $this->getVCartId(),
            'v_currency' => $this->getVCurrency(),
            'v_amount' => number_format($this->getVAmount(), 2),
            'signature' => $this->signature(
                $this->getSignatureKey(),
                $this->getCID(),
                $this->getVCartId(),
                $this->getVAmount(),
                $this->getVCurrency(),
            ),

            // optional at doc, but is better to include, the more detail the transactions
            'v_firstname' => $this->getVFirstName(),
            'v_lastname' => $this->getVLastName(),
            'v_billphone' => $this->getVBillPhone(),
            'v_productdesc' => $this->getVProductDesc(),
            'returnurl' => $this->getReturnUrl(),
            'callbackurl' => $this->getCallbackUrl(),
        ];
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    private function signature($signatureKey, $CID, $v_cartid, $v_amount, $v_currency)
    {
        //format: Sha512 (SIGNATUREKEY ; CID ; V_CARTID ; V_AMOUNT ; V_CURRENCY)
        // NOTE
        // The combined string shall be UPPERCASED before the SHA512 hash computation.
        // Amount shall always convert to two decimal places and consists only of digits. e.g 100.00 shall be converted to 10000 , 1 shall be converted to 100
        $v_amount = str_replace([',', '.'], '', $v_amount);
        $paramsInArray = array_map('strtoupper', [$signatureKey, $CID, $v_cartid, $v_amount, $v_currency]);

        return $this->createSignatureFromString(implode(';', $paramsInArray));
    }

}
