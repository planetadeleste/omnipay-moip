<?php
/**
 * Inscricoes Xtreme
 * Created by alvaro.
 * User: alvaro
 * Date: 23/05/19
 * Time: 04:23 PM
 */

namespace Omnipay\Moip\Message;


use Omnipay\Common\Message\AbstractResponse;

class ResponseBase extends AbstractResponse
{

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return !isset($this->data['error']) && !isset($this->data['errors']);
    }
}