<?php

namespace Omnipay\Gkash\Message;

use Omnipay\Common\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    protected $endpoint = 'https://api-staging.pay.asia/api/PaymentForm.aspx';

    public function getStatus()
    {
        return $this->data['status'];
    }

    public function getCID()
    {
        return $this->data['CID'];
    }

    public function getPOID()
    {

        return $this->data['POID'];
    }

    public function getCartId()
    {
        return $this->data['cartid'];
    }

    public function getCurrency()
    {
        return $this->data['currency'];
    }

    public function getAmount()
    {
        return $this->data['amount'];
    }

    public function getSignature()
    {
        return $this->data['signature'];
    }

    public function isTransparentRedirect()
    {
        return true;
    }

    public function isRedirect()
    {
        return true;
    }

    public function isSuccessful()
    {
        return false;
    }

    public function getRedirectUrl()
    {
        return $this->endpoint;
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->data;
    }

}
