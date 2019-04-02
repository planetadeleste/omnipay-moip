<?php

namespace Omnipay\Moip\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * Live Endpoint URL
     *
     * @var string URL
     */
    protected $liveEndpoint = 'https://api.moip.com.br/v2';

    /**
     * Test Endpoint URL
     *
     * @var string URL
     */
    protected $testEndpoint = 'https://sandbox.moip.com.br/v2';

    /**
     * Set api key authentication service
     *
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->setParameter('apiKey', $apiKey);
    }

    /**
     * Get api key authentication service
     *
     * @return string $apiKey
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @param mixed $data
     *
     * @return \Omnipay\Common\Message\ResponseInterface|\Omnipay\Moip\Message\Response
     */
    public function sendData($data)
    {
        $this->addListener4xxErrors();

        $headers = [
            'Authorization' => 'Basic '.base64_encode($this->getToken().':'.$this->getApiKey()),
            'Content-Type'  => 'application/json'
        ];
        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            $headers,
            json_encode($data)
        );

        $httpResponse = $httpRequest->send();
        return $this->createResponse($httpResponse->json());
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
     * @return \Omnipay\Moip\Message\Response
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
     * Get the customer reference.
     *
     * @return string
     */
    public function getCustomerReference()
    {
        return $this->getParameter('customerReference');
    }

    /**
     * Set the customer reference.
     *
     * Used when calling CreateCard on an existing customer.  If this
     * parameter is not set then a new customer is created.
     *
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCustomerReference($value)
    {
        return $this->setParameter('customerReference', $value);
    }

    /**
     * Get the order reference.
     *
     * @return string
     */
    public function getOrderReference()
    {
        return $this->getParameter('orderReference');
    }

    /**
     * Set the order reference.
     *
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOrderReference($value)
    {
        return $this->setParameter('orderReference', $value);
    }

    /**
     * Get the card data.
     *
     * Because the stripe gateway uses a common format for passing
     * card data to the API, this function can be called to get the
     * data from the associated card object in the format that the
     * API requires.
     *
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     */
    protected function getCardData()
    {
        $card = $this->getCard();
        $card->validate();

        $data = [];
        $data['number'] = $card->getNumber();
        $data['expirationMonth'] = $card->getExpiryMonth();
        $data['expirationYear'] = $card->getExpiryYear();
        if ($card->getCvv()) {
            $data['cvc'] = $card->getCvv();
        }
        $data['name'] = $card->getName();
        $data['address_line1'] = $card->getAddress1();
        $data['address_line2'] = $card->getAddress2();
        $data['address_city'] = $card->getCity();
        $data['address_zip'] = $card->getPostcode();
        $data['address_state'] = $card->getState();
        $data['address_country'] = $card->getCountry();
        $data['email'] = $card->getEmail();

        return $data;
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