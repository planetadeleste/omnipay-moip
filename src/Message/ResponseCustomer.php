<?php namespace Omnipay\Moip\Message;

/**
 * Class ResponseCustomer
 *
 * @property-read null|array $fundingInstruments
 * @property-read null|array $fundingInstrument
 *
 * @method null|mixed getFundingInstruments($default = null) = [
 *      [
 *      "creditCard" =>  [
 *         "id"     => "CRC-PDYFLH4PCV8M",
 *         "brand"  => "HIPER",
 *         "first6" => "637095",
 *         "last4"  => "0005",
 *         "store"  => true
 *         ],
 *          "method" => "CREDIT_CARD"
 *      ]
 * ]
 * @method null|mixed getFundingInstrument($default = null) = [
 *      "creditCard" =>  [
 *         "id"     => "CRC-PDYFLH4PCV8M",
 *         "brand"  => "HIPER",
 *         "first6" => "637095",
 *         "last4"  => "0005",
 *         "store"  => true
 *         ],
 *          "method" => "CREDIT_CARD"
 *      ]
 *
 * @package Omnipay\Moip\Message
 */
class ResponseCustomer extends ResponseBase
{

}