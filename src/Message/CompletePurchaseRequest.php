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
        $data = $this->httpClient->request('post', $this->endpoint,
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            json_encode([
                'version' => $this->getVersion(),
                'CID' => $data['CID'],
                'cartid' => $data['cartid'],
                'amount' => $data['amount'],
                'currency' => $data['currency'],
                'signature' => $data['signature'],
            ]))
            ->getBody()
            ->getContents();

        return $this->response = new CompletePurchaseResponse($this, $data);
    }

}
