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
        return !isset($this->data['error']) && !isset($this->data['ERROR']) && !isset($this->data['errors']);
    }

    /**
     * @param null|string $key
     * @param null|mixed $default
     *
     * @return mixed|null
     */
    public function getDataValue($key = null, $default = null)
    {
        if (!$key) {
            return $this->getData();
        }

        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }

    /**
     * @param string $name
     *
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->getDataValue($name);
    }

    /**
     * @param string $name  Method name must be start with `get`
     * @param array $arguments
     *
     * @return mixed|null
     */
    public function __call($name, $arguments = [])
    {
        $default = empty($arguments) ? null : $arguments[0];
        $paramName = lcfirst(substr($name, 3));

        return $this->getDataValue($paramName, $default);
    }
}