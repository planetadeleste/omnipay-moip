<?php
/**
 * omipay-moip
 * Created by alvaro.
 * User: alvaro
 * Date: 26/03/19
 * Time: 06:32 AM
 */

namespace Omnipay\Moip\Message;


class PurchaseRequest extends CreateOrderRequest
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

        $this->validate('orderReference');

        $data = [
            'fundingInstrument' => $this->getFundingInstrumentData(),
        ];

        if($this->getPaymentMethod() == 'CREDIT_CARD') {
            $data['installmentCount'] = ($this->getInstallmentCount()) ? $this->getInstallmentCount() : 1;
        }

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

    protected function getEndpoint()
    {
        return parent::getEndpoint().'/'.$this->getOrderReference().'/payments';
    }
}