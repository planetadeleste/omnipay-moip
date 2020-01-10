<?php namespace Omnipay\Moip\Message;

class ResponseWebhookList extends ResponseBase
{
    const STATUS_FAILED = 'FAILED';
    const STATUS_SENT = 'SENT';

    /**
     * @return array|mixed = [
     *     [
     *          "id" => "EVE-5JCOX7NUFBY5",
     *          "resourceId" => "PAY-7ADJ5MGOM5Y1",
     *          "event" => "PAYMENT.AUTHORIZED",
     *          "url" => "http://requestb.in/1h1enyc1",
     *          "status" => "SENT",
     *          "sentAt" => "2015-09-17T14:42:24.908Z"
     *      ]
     * ]
     */
    public function getWebhooks()
    {
        return $this->getDataValue('webhooks', []);
    }

    /**
     * @param array $value
     *
     * @return array
     */
    public function getFailed(array $value = [])
    {
        $status = ['status' => self::STATUS_FAILED];
        return $this->getByStatus(array_merge($value, $status));
    }

    /**
     * @param array $value
     *
     * @return array
     */
    public function getSent(array $value = [])
    {
        $status = ['status' => self::STATUS_SENT];
        return $this->getByStatus(array_merge($value, $status));
    }

    /**
     * @param array $match
     *
     * @return array
     */
    protected function getByStatus(array $match)
    {
        $webhooks = $this->getWebhooks();
        if (empty($webhooks)) {
            return [];
        }

        return array_filter(
            $webhooks,
            function ($v) use ($match) {
                $valid = false;
                foreach ($match as $key => $val) {
                    $valid = $v[$key] == $val;
                }
                return $valid;
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}