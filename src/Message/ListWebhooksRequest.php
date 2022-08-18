<?php namespace Omnipay\Moip\Message;

/**
 * Class CreateNotifyListRequest
 *
 * @package Omnipay\Moip\Message
 * @see https://dev.wirecard.com.br/reference#listar-todos-os-webhooks-enviados
 */
class ListWebhooksRequest extends AbstractRequest
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
        return parent::getEndpoint() . '/webhooks';
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