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

        $httpRequest = $this->httpClient->post($this->getEndpoint(), null, http_build_query($data, '', '&'));
        $httpResponse = $httpRequest->send();

        return $this->createResponse($httpResponse->getBody());
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
     * @param $data
     *
     * @return \PlanetaDelEste\Omnipay\Moip\Message\Response
     */
    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
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
     * Set client Id
     *
     * @param string $ownId
     */
    public function setOwnId($ownId)
    {
        $this->setParameter('ownId', $ownId);
    }

    /**
     * Get client Id
     *
     * @return string $ownId
     */
    public function getOwnId()
    {
        return $this->getParameter('ownId');
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