<?php

namespace PlanetaDelEste\Omnipay\Moip\Message;


use Moip\Moip;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * Live Endpoint URL
     *
     * @var string URL
     */
    protected $liveEndpoint = Moip::ENDPOINT_PRODUCTION;

    /**
     * Test Endpoint URL
     *
     * @var string URL
     */
    protected $testEndpoint = Moip::ENDPOINT_SANDBOX;

    public function sendData($data) {
        $this->addListener4xxErrors();

        $this->httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            $this->getData()
        );

        $httpResponse = $this->httpRequest->send();
    }

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
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string the HTTP method
     */
    protected function getHttpMethod()
    {
        return 'POST';
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


    /**
     * Don't throw exceptions for 4xx errors
     */
    private function addListener4xxErrors()
    {
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );
    }
}