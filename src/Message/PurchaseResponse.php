<?php

namespace Omnipay\Gkash\Message;

use Omnipay\Common\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    protected $endpoint = 'https://api-staging.pay.asia/api/PaymentForm.aspx';

    public function getTransactionId()
    {
        return $this->data['v_cartid'];
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
