<?php

namespace Omnipay\Moip\Message;


use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return !isset($this->data['error']) && !isset($this->data['errors']);
    }

    public function getTransactionId()
    {
        if(isset($this->data['id'])) {
            return (strtoupper( substr($this->data['id'], 0, 3) ) == 'PAY') ? $this->data['id'] : null;
        }

        return null;
    }

    /**
     * Get customer reference Id from createCustomer or createOrder requests
     *
     * @return string|null
     */
    public function getCustomerReference()
    {
        if(isset($this->data['customer']) && array_key_exists('id', $this->data['customer'])) {
            return $this->data['customer']['id'];
        } elseif (isset($this->data['id'])) {
            return (strtoupper( substr($this->data['id'], 0, 3) ) == 'CUS') ? $this->data['id'] : null;
        }

        return null;
    }

    /**
     * Get Order reference from createOrder
     *
     * @return string|null
     */
    public function getOrderReference()
    {
        if(isset($this->data['id'])) {
            return (strtoupper( substr($this->data['id'], 0, 3) ) == 'ORD') ? $this->data['id'] : null;
        }

        return null;
    }

    /**
     * @return array|null [['code' => 'ORD-001', 'path' => 'ownId', 'description' => 'Error message']]
     */
    public function getErrors()
    {
        return (isset($this->data['errors'])) ? $this->data['errors'] : null;
    }
}