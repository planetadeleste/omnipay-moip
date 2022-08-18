<?php namespace Omnipay\Moip;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Moip\Message\AuthorizeRequest;
use Omnipay\Moip\Message\CreateCustomerRequest;
use Omnipay\Moip\Message\CreateNotifyRequest;
use Omnipay\Moip\Message\CreateOrderRequest;
use Omnipay\Moip\Message\GetCustomerRequest;
use Omnipay\Moip\Message\ListNotifyRequest;
use Omnipay\Moip\Message\ListWebhooksRequest;
use Omnipay\Moip\Message\PurchaseRequest;
use Omnipay\Moip\Message\ResendWebhooksRequest;

/**
 * @method RequestInterface completeAuthorize(array $options = [])
 * @method RequestInterface capture(array $options = [])
 * @method RequestInterface completePurchase(array $options = [])
 * @method RequestInterface refund(array $options = [])
 * @method RequestInterface void(array $options = [])
 * @method RequestInterface createCard(array $options = [])
 * @method RequestInterface updateCard(array $options = [])
 * @method RequestInterface deleteCard(array $options = [])
 */
class Gateway extends AbstractGateway
{
    public function getDefaultParameters(): array
    {
        return [
            'token'    => '',
            'apiKey'   => '',
            'testMode' => false,
        ];
    }

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name gateway.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Moip';
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
    public function getToken(): string
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
    public function getApiKey(): string
    {
        return $this->getParameter('apiKey');
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
    public function getOwnId(): string
    {
        return $this->getParameter('ownId');
    }


    /**
     * Create request for to consume service
     *
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function authorize(array $options = []): AbstractRequest
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $options = [])
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function createCustomer(array $options = []): AbstractRequest
    {
        return $this->createRequest(CreateCustomerRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function createOrder(array $options = []): AbstractRequest
    {
        return $this->createRequest(CreateOrderRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function createNotify(array $options = []): AbstractRequest
    {
        return $this->createRequest(CreateNotifyRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function customer(array $options = []): AbstractRequest
    {
        return $this->createRequest(GetCustomerRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function listWebhooks(array $options = []): AbstractRequest
    {
        return $this->createRequest(ListWebhooksRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function listNotify(array $options = []): AbstractRequest
    {
        return $this->createRequest(ListNotifyRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function resendWebhooks(array $options = []): AbstractRequest
    {
        return $this->createRequest(ResendWebhooksRequest::class, $options);
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface purchase(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }
}