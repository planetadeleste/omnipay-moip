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
        return !isset($this->data['error']);
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
            return $this->data['id'];
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
            return $this->data['id'];
        }

        return null;
    }
}