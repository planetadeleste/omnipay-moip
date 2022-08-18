<?php
namespace Omnipay\Moip\Message;


class GetCustomerRequest extends AbstractRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('customerId');
        return [];
    }

    public function setCustomerId($customerId)
    {
        $this->setParameter('customerId', $customerId);
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }

    /**
     * @return string
     */
    protected function getHttpMethod(): string
    {
        return 'GET';
    }

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return parent::getEndpoint().'/customers/' . $this->getCustomerId();
    }

    /**
     * @param $data
     *
     * @return \Omnipay\Moip\Message\ResponseCustomer
     */
    protected function createResponse($data)
    {
        return $this->response = new ResponseCustomer($this, $data);
    }
}