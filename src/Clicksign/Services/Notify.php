<?php


namespace Clicksign\Services;


use AppClient;

/**
 * Class Notify
 * @package Clicksign\Services
 */
class Notify extends Service
{
    /**
     * @param $request_signature_key
     * @param $message
     * @param null $url
     * @return mixed|string
     */
    public function sendByEmail($request_signature_key, $message, $url = null)
    {
        $data['body'] = [
            'request_signature_key' => $request_signature_key,
            'message' => $message,
            'url' => $url
        ];

        return $this->clicksign->doRequestCurl('POST', 'notifications', $data);
    }

    /**
     * @param $request_signature_key
     * @return mixed|string
     */
    public function sendBySms($request_signature_key)
    {
        $data['body'] = [
            'request_signature_key' => $request_signature_key
        ];

        return $this->clicksign->doRequestCurl('POST', 'notify_by_sms', $data);
    }

    /**
     * @param string $request_signature_key
     * @return mixed|string
     */
    public function sendByWhatsApp($request_signature_key)
    {
        $data['body'] = [
            'request_signature_key' => $request_signature_key
        ];

        return $this->clicksign->doRequestCurl('POST', 'notify_by_whatsapp', $data);
    }

}
