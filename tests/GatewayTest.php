<?php

namespace Omnipay\Gkash;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    protected $gateway;

    /** @var array */
    private $options;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->setSignatureKey('nBgRevhdrmJBGAC');
        $this->gateway->setCID('M161-U-20445');

        $this->options = [
            'v_cartid' => 'PO#00046', #string, order id from merchant
            'v_currency' => 'MYR', #string, MYR
            'v_amount' => '1.00', #string, payment amt
            // optional
            'v_firstname' => 'Hin',
            'v_lastname' => 'Han Yi',
            'v_billphone' => '0124517885',
            'v_productdesc' => 'TOP UP',
        ];
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
    }

    public function testCompletePurchase()
    {

        $this->getHttpRequest()->request->replace([
            'status' => 'Pending',
            'description' => 'XE - Invalid Message',
            'CID' => 'M161-U-20445',
            'POID' => 'M161-PO-103747',
            'cartid' => 'PO#00009',
            'amount' => '1.00',
            'currency' => 'MYR',
            'PaymentType' => 'Online Banking FPX',
            'signature' => '59ce5831eeeb8c14bdd0dae8d455e30d1499eea62ea705a03d9cf994a252f975019d47051be3e3f724424d85b9f6338bfd5fa2d5535e4b1b208d0cc2f297a034',
        ]);

        $this->setMockHttpResponse('CompletePurchaseRequestReQuerySuccess.txt');

        $response = $this->gateway->completePurchase($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('M161-PO-103747', $response->getTransactionReference());
    }
}
