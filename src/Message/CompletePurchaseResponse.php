<?php

namespace Omnipay\Gkash\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompletePurchaseResponse extends AbstractResponse
{
    private $reQueryResponse = [
        '88' => 'Successful payment',
        '66' => 'Payment fail',
        '11' => 'Payment Pending',
        '99' => 'Error',
    ];

    protected $message;

    protected $status;

    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        $this->data = json_decode($this->data, true);

        $intstatus = intval($this->data['status']);

        if (88 != $intstatus) {
            $this->message = $this->data['description'];
            $this->status = false;
            return;
        }

        $this->message = isset($this->reQueryResponse[$intstatus]) ? $this->reQueryResponse[$intstatus] : $this->data['status'];

        if (88 == $intstatus) {
            $this->status = true;
            return;
        }

        $this->status = false;
        return;

    }

    public function isSuccessful()
    {
        return $this->status;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getTransactionReference()
    {
        return $this->data['POID'];
    }

    public function getTransactionId()
    {
        return $this->data['cartid'];
    }

}
