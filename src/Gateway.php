<?php
namespace Omnipay\Gkash;

use Omnipay\Common\AbstractGateway;

/**
 * iPay8 Gateway Driver for Omnipay
 *
 * This driver is based on
 * Online Payment Switching Gateway Technical Specification Version 1.6.1
 * @link https://drive.google.com/file/d/1iOpAHu-NrX3s63aYDe8i3sBMRZbDWifS/view?usp=sharing
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'gkash';
    }

    public function getDefaultParameters()
    {

        return [
            'SignatureKey' => '',
            'CID' => '',
        ];

    }

    public function getSignatureKey()
    {
        return $this->getParameter('SignatureKey');
    }

    public function setSignatureKey($signature_key)
    {
        // signature key, received at email when registered
        return $this->setParameter('SignatureKey', $signature_key);
    }

    public function getCID()
    {
        return $this->getParameter('CID');
    }

    public function setCID($cid)
    {
        // merchant ID
        return $this->setParameter('CID', $cid);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Gkash\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Gkash\Message\CompletePurchaseRequest', $parameters);
    }

}
