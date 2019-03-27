<?php

namespace Omnipay\Moip\Message;


class CreateOrderRequest extends CreateCustomerRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     */
    public function getData()
    {
        /** @var \Omnipay\Common\Item $item */

        $this->validate('amount', 'currency', 'items');

        $data = [
            'ownId'    => $this->getOwnId(),
            'amount'   => [
                'currency' => $this->getCurrency()
            ],
            'items'    => [],
            'customer' => []
        ];

        if ($this->getCustomerReference()) {
            $data['customer']['id'] = $this->getCustomerReference();
        } else {
            $data['customer'] = parent::getData();
        }

        $items = $this->getItems();
        if ($items) {
            foreach ($items as $item) {
                $dataItem = [
                    'product'  => $item->getName(),
                    'quantity' => $item->getQuantity(),
                    'detail'   => $item->getDescription(),
                    'price'    => $item->getPrice()
                ];
                $data['items'][] = $dataItem;

            }
        }

        return $data;
    }

    protected function getEndpoint()
    {
        return AbstractRequest::getEndpoint().'/orders';
    }
}