<?php
namespace Omnipay\Moip\Message;

/**
 * Class NotifyRequest
 *
 * @package Omnipay\Moip\Message
 * @see https://dev.wirecard.com.br/reference#eventos
 */
class CreateNotifyRequest extends AbstractRequest
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
        $this->validate('events', 'target');

        $data = [
            'events' => $this->getEvents(),
            'target' => $this->getTarget(),
            'media'  => 'WEBHOOK'
        ];

        return $data;
    }

    /**
     * @param string $url
     */
    public function setTarget($url)
    {
        $this->setParameter('target', $url);
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->getParameter('target');
    }

    /**
     * @param string|array $events
     * @param bool         $push
     */
    public function setEvents($events, $push = true)
    {
        if(!is_array($events)) {
            $events = [$events];
        }

        if($push) {
            $_events = $this->getEvents();
            if(!empty($_events)) {
                $events = array_merge($_events, $events);
            }
        }

        $this->setParameter('events', array_unique($events));
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->getParameter('events');
    }

    /**
     * Set ORDER.* event notify
     *
     * @param bool $push
     */
    public function setEventOrders($push = true)
    {
        $this->setEvents('ORDER.*', $push);
    }

    /**
     * Set ORDER.CREATED event notify
     * @param bool $push
     */
    public function setEventOrderCreated($push = true)
    {
        $this->setEvents('ORDER.CREATED', $push);
    }

    /**
     * Set ORDER.WAITING event notify
     * @param bool $push
     */
    public function setEventOrderWaiting($push = true)
    {
        $this->setEvents('ORDER.WAITING', $push);
    }

    /**
     * Set ORDER.PAID event notify
     * @param bool $push
     */
    public function setEventOrderPaid($push = true)
    {
        $this->setEvents('ORDER.PAID', $push);
    }

    /**
     * Set ORDER.NOT_PAID event notify
     * @param bool $push
     */
    public function setEventOrderNotPaid($push = true)
    {
        $this->setEvents('ORDER.NOT_PAID', $push);
    }

    /**
     * Set ORDER.REVERTED event notify
     * @param bool $push
     */
    public function setEventOrderReverted($push = true)
    {
        $this->setEvents('ORDER.REVERTED', $push);
    }

    /**
     * Set PAYMENT.* event notify
     * @param bool $push
     */
    public function setEventPayments($push = true)
    {
        $this->setEvents('PAYMENT.*', $push);
    }

    /**
     * Set PAYMENT.CREATED event notify
     * @param bool $push
     */
    public function setEventPaymentCreated($push = true)
    {
        $this->setEvents('PAYMENT.CREATED', $push);
    }

    /**
     * Set PAYMENT.WAITING event notify
     * @param bool $push
     */
    public function setEventPaymentWaiting($push = true)
    {
        $this->setEvents('PAYMENT.WAITING', $push);
    }

    /**
     * Set PAYMENT.IN_ANALYSIS event notify
     * @param bool $push
     */
    public function setEventPaymentInAnalysis($push = true)
    {
        $this->setEvents('PAYMENT.IN_ANALYSIS', $push);
    }

    /**
     * Set PAYMENT.PRE_AUTHORIZED event notify
     * @param bool $push
     */
    public function setEventPaymentPreAuthorized($push = true)
    {
        $this->setEvents('PAYMENT.PRE_AUTHORIZED', $push);
    }

    /**
     * Set PAYMENT.AUTHORIZED event notify
     * @param bool $push
     */
    public function setEventPaymentAuthorized($push = true)
    {
        $this->setEvents('PAYMENT.AUTHORIZED', $push);
    }

    /**
     * Set PAYMENT.CANCELLED event notify
     * @param bool $push
     */
    public function setEventPaymentCancelled($push = true)
    {
        $this->setEvents('PAYMENT.CANCELLED', $push);
    }

    /**
     * Set PAYMENT.REFUNDED event notify
     * @param bool $push
     */
    public function setEventPaymentRefunded($push = true)
    {
        $this->setEvents('PAYMENT.REFUNDED', $push);
    }

    /**
     * Set PAYMENT.REVERSED event notify
     * @param bool $push
     */
    public function setEventPaymentReversed($push = true)
    {
        $this->setEvents('PAYMENT.REVERSED', $push);
    }

    /**
     * Set PAYMENT.SETTLED event notify
     *
     * @param bool $push
     */
    public function setEventPaymentSettled($push = true)
    {
        $this->setEvents('PAYMENT.SETTLED', $push);
    }

    protected function getEndpoint(): string
    {
        return parent::getEndpoint().'/preferences/notifications';
    }
}