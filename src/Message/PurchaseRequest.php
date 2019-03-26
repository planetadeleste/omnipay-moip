<?php
/**
 * omipay-moip
 * Created by alvaro.
 * User: alvaro
 * Date: 26/03/19
 * Time: 06:32 AM
 */

namespace PlanetaDelEste\Omnipay\Moip\Message;


class PurchaseRequest extends AbstractRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     */
    public function getData()
    {
        /** @var \Omnipay\Common\Item $item */

        $this->validate('amount', 'card');
        $this->getCard()->validate();

        $data = [];
        $data['ownId'] = $this->getOwnId();
        $data['amount'] = [
            'currency' => $this->getCurrency()
        ];

        $data['items'] = [];
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
}