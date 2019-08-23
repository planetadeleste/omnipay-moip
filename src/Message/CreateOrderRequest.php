<?php

namespace Omnipay\Moip\Message;

use PlanetaDelEste\VendorsShopaholic\Classes\Helper\PriceHelper;

class CreateOrderRequest extends CreateCustomerRequest
{
    /**
     * Set client Id
     *
     * @param string $ownId
     */
    public function setOrderOwnId($ownId)
    {
        $this->setParameter('orderOwnId', $ownId);
    }

    /**
     * Get client Id
     *
     * @return string $ownId
     */
    public function getOrderOwnId()
    {
        return $this->getParameter('orderOwnId');
    }

    /**
     * @param int $value
     */
    public function setInstallmentCount($value)
    {
        $this->setParameter('installmentCount', $value);
    }

    public function getInstallmentCount()
    {
        return $this->getParameter('installmentCount');
    }

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
            'ownId'    => $this->getOrderOwnId(),
            'amount'   => [
                'currency' => $this->getCurrency()
            ],
            'items'    => [],
            'customer' => []
        ];

        if($this->getCustomerId()) {
            $data['customer']['id'] = $this->getCustomerId();
        } elseif ($this->getCustomerReference()) {
            $data['customer']['id'] = $this->getCustomerReference();
        } else {
            $data['customer'] = parent::getData();
        }

        if(array_key_exists('fundingInstrument', $data['customer'])) {
            unset($data['customer']['fundingInstrument']);
        }

        $items = $this->getItems();
        $total = 0;
        if ($items) {
            foreach ($items as $item) {
                $dataItem = [
                    'product'  => $item->getName(),
                    'quantity' => $item->getQuantity(),
                    'detail'   => $item->getDescription(),
                    'price'    => $item->getPrice()
                ];
                $data['items'][] = $dataItem;
                $total += $item->getPrice();
            }
        }

        $installment = $this->getInstallmentCount();
        if($installment > 1 && $total) {
            $total = floatval( $total / 100 );
            $addition = PriceHelper::addition($installment, $total);
            if($addition) {
                $data['amount']['subtotals'] = [
                    'addition' => intval($addition * 100)
                ];
            }
        }

        return $data;
    }

    protected function getEndpoint()
    {
        return AbstractRequest::getEndpoint().'/orders';
    }
}