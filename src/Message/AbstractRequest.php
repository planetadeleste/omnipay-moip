<?php

namespace Bavarianlabs\Omnipay\Moip\Message;


use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * Live Endpoint URL
     *
     * @var string URL
     */
    protected $liveEndpoint = 'https://www.moip.com.br';

    /**
     * Test Endpoint URL
     *
     * @var string URL
     */
    protected $testEndpoint = 'https://desenvolvedor.moip.com.br/sandbox';

    /**
     * Verify environment of the service payment and return correct endpoint url
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->getTestEndpoint() : $this->getLiveEndpoint();
    }

    /**
     * Return production environment url of service
     *
     * @return string
     */
    private function getLiveEndpoint()
    {
        return $this->liveEndpoint;
    }

    /**
     * Return test environment url of service
     *
     * @return string
     */
    private function getTestEndpoint()
    {
        return $this->testEndpoint;
    }
}