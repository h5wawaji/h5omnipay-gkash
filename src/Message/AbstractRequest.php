<?php

namespace Omnipay\Gkash\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{

    public function getVersion()
    {
        return '1.5.5';
    }

    public function getQueryVersion()
    {
        return '1.3.0';
    }

    public function getSignatureKey()
    {
        return $this->getParameter('SignatureKey');
    }

    public function setSignatureKey($signatureKey)
    {
        return $this->setParameter('SignatureKey', $signatureKey);
    }

    public function getCID()
    {
        return $this->getParameter('CID');
    }

    public function setCID($cid)
    {
        return $this->setParameter('CID', $cid);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnurl');
    }

    public function setReturnUrl($returnurl)
    {
        return $this->setParameter('returnurl', $returnurl);
    }

    public function getCallbackUrl()
    {
        return $this->getParameter('callbackurl');
    }

    public function setCallbackUrl($callbackurl)
    {
        return $this->setParameter('callbackurl', $callbackurl);
    }

    public function getVCartId()
    {
        return $this->getParameter('v_cartid');
    }

    public function setVCartId($v_cartid)
    {
        return $this->setParameter('v_cartid', $v_cartid);
    }

    public function getVCurrency()
    {
        return $this->getParameter('v_currency');
    }

    public function setVCurrency($v_currency)
    {
        return $this->setParameter('v_currency', $v_currency);
    }

    public function getVAmount()
    {
        return $this->getParameter('v_amount');
    }

    public function setVAmount($v_amount)
    {
        return $this->setParameter('v_amount', $v_amount);
    }

    public function getVFirstName()
    {
        return $this->getParameter('v_firstname');
    }

    public function setVFirstName($v_firstname)
    {
        return $this->setParameter('v_firstname', $v_firstname);
    }

    public function getVLastName()
    {
        return $this->getParameter('v_lastname');
    }

    public function setVLastName($v_lastname)
    {
        return $this->setParameter('v_lastname', $v_lastname);
    }

    public function getVBillPhone()
    {
        return $this->getParameter('v_billphone');
    }

    public function setVBillPhone($v_billphone)
    {
        return $this->setParameter('v_billphone', $v_billphone);
    }

    public function getVProductDesc()
    {
        return $this->getParameter('v_productdesc');
    }

    public function setVProductDesc($v_productdesc)
    {
        return $this->setParameter('v_productdesc', $v_productdesc);
    }

    protected function guardParameters()
    {
        // require validation
        $this->validate(
            'v_cartid',
            'v_currency',
            'v_amount',
            // optional based on doc, but should be have just like ipay88
            'v_productdesc',
            'v_firstname',
            'returnurl',
            'callbackurl',
        );
    }

    protected function createSignatureFromString($fullStringToHash)
    {
        return hash('sha512', $fullStringToHash);
    }

    // private function hex2bin($hexSource)
    // {
    //     $bin = '';
    //     for ($i = 0; $i < strlen($hexSource); $i = $i + 2) {
    //         $bin .= chr(hexdec(substr($hexSource, $i, 2)));
    //     }
    //     return $bin;
    // }
}
