<?php namespace Omnipay\Moip\Message;

class ResendWebhooksRequest extends AbstractRequest
{

    /**
     * @inheritDoc
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('resourceId', 'event');

        return [
            'resourceId' => $this->getResourceId(),
            'event'      => $this->getEvent()
        ];
    }

    /**
     * @param string $resourceId
     */
    public function setResourceId($resourceId)
    {
        $this->setParameter('resourceId', $resourceId);
    }

    /**
     * @return string
     */
    public function getResourceId()
    {
        return $this->getParameter('resourceId');
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->setParameter('event', $event);
    }

    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->getParameter('event');
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint().'/webhooks';
    }

    /**
     * @param array $data
     *
     * @return \Omnipay\Moip\Message\ResponseWebhook
     */
    protected function createResponse($data)
    {
        return $this->response = new ResponseWebhook($this, $data);
    }
}