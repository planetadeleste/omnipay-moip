<?php

namespace PlanetaDelEste\Omnipay\Moip;


use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name gateway.
     *
     * @return string
     */
    public function getName()
    {
        return 'MoIP Payment';
    }

    /**
     * Get gateway display short name
     *
     * This can be used by developers to get the short display name gateway.
     *
     * @return string
     */
    public function getShortName()
    {
        return 'MoIP';
    }


    /**
     * Set token authorization service
     *
     * @param string $token
     */
    public function setToken($token)
    {
        $this->setParameter('token', $token);
    }

    /**
     * Get token authorization service
     *
     * @return string
     */
    public function getToken()
    {
        return $this->getParameter('token');
    }

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
     * Create request for to consume service
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\PlanetaDelEste\Omnipay\Moip\Message\AuthorizeRequest', $parameters);
    }

}