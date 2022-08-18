<?php namespace Omnipay\Moip\Message;

use Omnipay\Common\Message\AbstractResponse;

class ListNotifyRequest extends AbstractRequest
{

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return [];
    }

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return parent::getEndpoint().'/preferences/notifications';
    }

    /**
     * @return string
     */
    protected function getHttpMethod(): string
    {
        return 'GET';
    }

    /**
     * @param array $data
     *
     * @return \Omnipay\Moip\Message\ResponseWebhookList
     */
    protected function createResponse($data)
    {
        return $this->response = new ResponseWebhookList($this, $data);
    }
}