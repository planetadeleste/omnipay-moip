<?php namespace Omnipay\Moip\Message;

/**
 * Class ResponseWebhook
 *
 * @property-read null|string $id
 * @property-read null|string $resourceId
 * @property-read null|string $event
 * @property-read null|string $url
 * @property-read null|string $status
 * @property-read null|string $sentAt
 *
 * @method null|mixed getId($default = null)
 * @method null|mixed getResourceId($default = null)
 * @method null|mixed getEvent($default = null)
 * @method null|mixed getUrl($default = null)
 * @method null|mixed getStatus($default = null)
 * @method null|mixed getSentAt($default = null)
 *
 * @package Omnipay\Moip\Message
 */
class ResponseWebhook extends ResponseBase
{
    /**
     * @return array = [
     *     "id" => "EVE-5JCOX7NUFBY5",
     *     "resourceId" => "PAY-7ADJ5MGOM5Y1",
     *     "event" => "PAYMENT.AUTHORIZED",
     *     "url" => "http://requestb.in/1h1enyc1",
     *     "status" => "SENT",
     *     "sentAt" => "2015-09-17T14:42:24.908Z"
     * ]
     */
    public function getWebhook()
    {
        return $this->getData();
    }
}