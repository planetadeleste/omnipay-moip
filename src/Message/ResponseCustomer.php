<?php
/**
 * Inscricoes Xtreme
 * Created by alvaro.
 * User: alvaro
 * Date: 23/05/19
 * Time: 04:25 PM
 */

namespace Omnipay\Moip\Message;


class ResponseCustomer extends ResponseBase
{
    /**
     * @return null|array [
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
     */
    public function getFundingInstruments()
    {
        if (isset($this->data['fundingInstruments'])) {
            return $this->data['fundingInstruments'];
        }

        return null;
    }

    /**
     * @return null | array [
     *      "creditCard" =>  [
     *         "id"     => "CRC-PDYFLH4PCV8M",
     *         "brand"  => "HIPER",
     *         "first6" => "637095",
     *         "last4"  => "0005",
     *         "store"  => true
     *         ],
     *          "method" => "CREDIT_CARD"
     *      ]
     */
    public function getFundingInstrument()
    {
        if (isset($this->data['fundingInstrument'])) {
            return $this->data['fundingInstrument'];
        }

        return null;
    }

}