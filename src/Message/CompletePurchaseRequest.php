<?php

namespace Omnipay\Gkash\Message;

class CompletePurchaseRequest extends AbstractRequest
{

    #QUERY section, endpoint change to query
    protected $endpoint = 'https://api-staging.pay.asia/api/payment/query';

    public function getData()
    {
        $this->guardParameters();

        $data = $this->httpRequest->request->all();

        return $data;
    }

    public function sendData($data)
    {

        $data = $this->httpClient->request('post', $this->endpoint, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ], json_encode([
            'version' => $this->getQueryVersion(),
            'CID' => $data['CID'],
            'cartid' => $data['cartid'],
            'amount' => $data['amount'],
            'currency' => $data['currency'],
            'signature' => $this->signature(
                $this->getSignatureKey(),
                $data['CID'],
                $data['cartid'],
                $data['amount'],
                $data['currency'],
            ),
        ]))
            ->getBody()
            ->getContents();

        return $this->response = new CompletePurchaseResponse($this, $data);
    }

    private function signature($signatureKey, $CID, $cartid, $amount, $currency)
    {
        //format: Sha512 (SIGNATUREKEY ; CID ; CARTID ; AMOUNT ; CURRENCY)
        // NOTE
        // The combined string shall be UPPERCASED before the SHA512 hash computation.
        // Amount shall always convert to two decimal places and consists only of digits. e.g 100.00 shall be converted to 10000 , 1 shall be converted to 100
        $amount = str_replace([',', '.'], '', $amount);
        $paramsInArray = array_map('strtoupper', [$signatureKey, $CID, $cartid, $amount, $currency]);

        return $this->createSignatureFromString(implode(';', $paramsInArray));
    }

}
