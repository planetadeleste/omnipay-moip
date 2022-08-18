<?php

namespace Omnipay\Moip\Message;


class CreateCustomerRequest extends AbstractRequest
{
    /**
     * Set client Moip Id
     *
     * @param string $id
     */
    public function setCustomerId($id)
    {
        $this->setParameter('customerId', $id);
    }

    /**
     * Get client Moip Id
     *
     * @return string $ownId
     */
    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }
    /**
     * Set client Id
     *
     * @param string $ownId
     */
    public function setCustomerOwnId($ownId)
    {
        $this->setParameter('customerOwnId', $ownId);
    }

    /**
     * Get client Id
     *
     * @return string $ownId
     */
    public function getCustomerOwnId()
    {
        return $this->getParameter('customerOwnId');
    }

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
     * @param mixed $billingTaxDocumentNumber
     */
    public function setBillingTaxDocumentNumber($billingTaxDocumentNumber)
    {
        $this->setParameter('billingTaxDocumentNumber', $billingTaxDocumentNumber);
    }

    /**
     * @return string
     */
    public function getBillingTaxDocumentNumber()
    {
        return $this->getParameter('billingTaxDocumentNumber');
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
     * @param mixed $cardOwner
     */
    public function setCardOwner($cardOwner)
    {
        $this->setParameter('cardOwner', $cardOwner);
    }

    /**
     * @return string
     */
    public function getCardOwner()
    {
        return $this->getParameter('cardOwner');
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->setParameter('firstName', $firstName);
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->getParameter('firstName');
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->setParameter('lastName', $lastName);
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->getParameter('lastName');
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->setParameter('birthday', $birthday);
    }

    /**
     * @return string
     */
    public function getBirthday()
    {
        return $this->getParameter('birthday');
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('paymentMethod');

        $card = $this->getCard();

        $data = [
            'ownId'             => $this->getCustomerOwnId(),
            'fullname'          => $this->getFirstName().' '.$this->getLastName(),
            'email'             => $card->getEmail(),
            'birthDate'         => $this->getBirthday(),
            'taxDocument'       => $this->getTaxDocumentParams(),
            'phone'             => $this->getPhoneParams($card),
            'shippingAddress'   => $this->getShippingParams($card),
        ];

        if($this->getCardOwner()) {
            $data['fundingInstrument'] = $this->getFundingInstrumentData();
        }

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
            'city'         => ($card->getShippingCity()) ?
                $card->getShippingCity() : $card->getBillingCity(),
            'district'     => ($this->getShippingDistrict()) ?
                $this->getShippingDistrict() : $this->getBillingDistrict(),
            'street'       => ($card->getShippingAddress1()) ?
                $card->getShippingAddress1() : $card->getBillingAddress1(),
            'streetNumber' => ($this->getShippingStreetNumber()) ?
                $this->getShippingStreetNumber() : $this->getBillingStreetNumber(),
            'zipCode'      => ($card->getShippingPostcode()) ?
                $card->getShippingPostcode() : $card->getBillingPostcode(),
            'state'        => ($card->getShippingState()) ?
                $card->getShippingState() : $card->getBillingState(),
            'country'      => ($card->getShippingCountry()) ?
                $card->getShippingCountry() : $card->getBillingCountry(),
        ];
    }

    /**
     * @param \Omnipay\Common\CreditCard $card
     *
     * @return array
     */
    public function getPhoneParams($card)
    {
        $phone = $card->getPhone();
        if(!$this->getAreaCode()) {
            $areaCode = substr($phone, 0, 2);
            $phone    = substr($phone, 2);
        } else {
            $areaCode = $this->getAreaCode();
        }

        return [
            'countryCode' => 55,
            'areaCode'    => $areaCode,
            'number'      => $phone,
        ];
    }

    /**
     * @param bool $billing
     *
     * @return array
     */
    public function getTaxDocumentParams($billing = false)
    {
        return [
            'type'   => ($this->getTaxDocumentType()) ? $this->getTaxDocumentType() : 'CPF',
            'number' => ($billing) ? $this->getBillingTaxDocumentNumber() : $this->getTaxDocumentNumber(),
        ];
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getFundingInstrumentData()
    {
        $this->validate('paymentMethod');

        $data = [
            'method' => $this->getPaymentMethod(),
        ];

        if ($this->getPaymentMethod() == 'BOLETO') {
            $data['boleto'] = $this->getBoletoData();
        } else {
            $data['creditCard'] = $this->getCardData();
        }

        return $data;
    }

    protected function getCardData(): array
    {
        $card = $this->getCard();
        $cardData = parent::getCardData();
        if(!array_key_exists('id', $cardData)) {
            $cardData['holder'] = [
                'fullname'       => $card->getFirstName().' '.$card->getLastName(),
                'birthdate'      => $card->getBirthday(),
                'taxDocument'    => $this->getTaxDocumentParams(true),
                'billingAddress' => $this->getBillingParams($card),
                'phone'          => $this->getPhoneParams($card),
            ];
        }

        return $cardData;
    }

    protected function getEndpoint(): string
    {
        return parent::getEndpoint().'/customers';
    }
}