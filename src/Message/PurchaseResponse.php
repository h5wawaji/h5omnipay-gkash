<?php

namespace Omnipay\Gkash\Message;

use Omnipay\Common\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{

    public function getVersion()
    {
        return $this->data['version'];
    }

    public function getCID()
    {
        return $this->data['CID'];
    }

    public function getTransactionId()
    {
        return $this->data['v_cartid'];
    }

    public function getVCurrency()
    {
        return $this->data['v_currency'];
    }

    public function getVAmount()
    {
        return $this->data['v_amount'];
    }

    public function getSignature()
    {
        return $this->data['signature'];
    }

    public function getVFirstName()
    {
        return $this->data['v_firstname'];
    }

    public function getVBillPhone()
    {
        return $this->data['v_billphone'];
    }

    public function getVBillEmail()
    {
        return $this->data['v_billemail'];
    }

    public function getVProductDesc()
    {
        return $this->data['v_productdesc'];
    }

    public function getReturnUrl()
    {
        return $this->data['returnurl'];
    }

    public function getCallbackUrl()
    {
        return $this->data['callbackurl'];
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
        return $this->data['redirect_endpoint'];
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
