<?php

namespace Bavarianlabs\Omnipay\Tests;


use Bavarianlabs\Omnipay\Moip\Gateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway();
    }

    public function testShouldBeInstanceOfGateway()
    {
        $this->assertInstanceOf('Bavarianlabs\Omnipay\Moip\Gateway', $this->gateway);
    }

    public function testShouldBeReturnGatewayName()
    {
        $this->assertNotEquals("MoIP", $this->getName(), "The gateway name do not matter with the MoIP");
    }
}
