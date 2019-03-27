<?php

namespace Omnipay\Moip\Message;


class CreateCustomerRequest extends AbstractRequest
{
    /**
     * Set client Tax Document type
     *
     * @param string $taxDocumentType
     */
    public function setTaxDocumentType($taxDocumentType)
    {
        $this->setParameter('taxDocumentType', $taxDocumentType);
    }

    /**
     * Get client Tax Document type
     *
     * @return string
     */
    public function getTaxDocumentType()
    {
        return $this->getParameter('taxDocumentType');
    }

    /**
     * Set client Tax Document number
     *
     * @param string $taxDocumentNumber
     */
    public function setTaxDocumentNumber($taxDocumentNumber)
    {
        $this->setParameter('taxDocumentNumber', $taxDocumentNumber);
    }

    /**
     * Get client Tax Document number
     *
     * @return string
     */
    public function getTaxDocumentNumber()
    {
        return $this->getParameter('taxDocumentNumber');
    }

    /**
     * Set client phone area code
     *
     * @param string $areaCode
     */
    public function setAreaCode($areaCode)
    {
        $this->setParameter('areaCode', $areaCode);
    }

    /**
     * Get client Tax Document number
     *
     * @return string
     */
    public function getAreaCode()
    {
        return $this->getParameter('areaCode');
    }

    /**
     * Set client Billing street number
     *
     * @param string $streetNumber
     */
    public function setBillingStreetNumber($streetNumber)
    {
        $this->setParameter('billingStreetNumber', $streetNumber);
    }

    /**
     * Get client Billing street number
     *
     * @return string
     */
    public function getBillingStreetNumber()
    {
        return $this->getParameter('billingStreetNumber');
    }

    /**
     * Set client Shipping street number
     *
     * @param string $streetNumber
     */
    public function setShippingStreetNumber($streetNumber)
    {
        $this->setParameter('shippingStreetNumber', $streetNumber);
    }

    /**
     * Get client Shipping street number
     *
     * @return string
     */
    public function getShippingStreetNumber()
    {
        return $this->getParameter('shippingStreetNumber');
    }

    /**
     * Set client billing district
     *
     * @param string $district
     */
    public function setBillingDistrict($district)
    {
        $this->setParameter('billingDistrict', $district);
    }

    /**
     * Get client billing district
     *
     * @return string
     */
    public function getBillingDistrict()
    {
        return $this->getParameter('billingDistrict');
    }

    /**
     * Set client shipping district
     *
     * @param string $district
     */
    public function setShippingDistrict($district)
    {
        $this->setParameter('shippingDistrict', $district);
    }

    /**
     * Get client shipping district
     *
     * @return string
     */
    public function getShippingDistrict()
    {
        return $this->getParameter('shippingDistrict');
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     */
    public function getData()
    {
        $card = $this->getCard();

        $cardData['holder'] = [
            'fullname'       => $card->getFirstName().' '.$card->getLastName(),
            'birthdate'      => $card->getBirthday(),
            'taxDocument'    => $this->getTaxDocumentParams(),
            'billingAddress' => $this->getBillingParams($card),
            'phone'          => $this->getPhoneParams($card),
        ];

        $data = [
            'ownId'             => $this->getOwnId(),
            'fullname'          => $card->getFirstName().' '.$card->getLastName(),
            'email'             => $card->getEmail(),
            'birthDate'         => $card->getBirthday(),
            'taxDocument'       => $this->getTaxDocumentParams(),
            'phone'             => $this->getPhoneParams($card),
            'shippingAddress'   => $this->getShippingParams($card),
            'fundingInstrument' => [
                'method'     => 'CREDIT_CARD',
                'creditCard' => $this->getCardData()
            ],
        ];

        return $data;
    }

    /**
     * @param \Omnipay\Common\CreditCard $card
     *
     * @return array
     */
    public function getBillingParams($card)
    {
        return [
            'city'         => $card->getBillingCity(),
            'district'     => $this->getBillingDistrict(),
            'street'       => $card->getBillingAddress1(),
            'streetNumber' => $this->getBillingStreetNumber(),
            'zipCode'      => $card->getBillingPostcode(),
            'state'        => $card->getBillingState(),
            'country'      => $card->getBillingCountry(),
        ];
    }

    /**
     * @param \Omnipay\Common\CreditCard $card
     *
     * @return array
     */
    public function getShippingParams($card)
    {
        return [
            'city'         => $card->getShippingCity(),
            'district'     => $this->getShippingDistrict(),
            'street'       => $card->getShippingAddress1(),
            'streetNumber' => $this->getShippingStreetNumber(),
            'zipCode'      => $card->getShippingPostcode(),
            'state'        => $card->getShippingState(),
            'country'      => $card->getShippingCountry(),
        ];
    }

    /**
     * @param \Omnipay\Common\CreditCard $card
     *
     * @return array
     */
    public function getPhoneParams($card)
    {
        return [
            'countryCode' => '55',
            'areaCode'    => $this->getAreaCode(),
            'number'      => $card->getPhone(),
        ];
    }

    /**
     * @return array
     */
    public function getTaxDocumentParams()
    {
        return [
            'type'   => ($this->getTaxDocumentType()) ? $this->getTaxDocumentType() : 'CPF',
            'number' => $this->getTaxDocumentNumber(),
        ];
    }

    protected function getCardData()
    {
        $card = $this->getCard();
        $cardData = parent::getCardData();
        $cardData['holder'] = [
            'fullname'       => $card->getFirstName().' '.$card->getLastName(),
            'birthdate'      => $card->getBirthday(),
            'taxDocument'    => $this->getTaxDocumentParams(),
            'billingAddress' => $this->getBillingParams($card),
            'phone'          => $this->getPhoneParams($card),
        ];

        return $cardData;
    }

    protected function getEndpoint()
    {
        return parent::getEndpoint().'/customers';
    }
}