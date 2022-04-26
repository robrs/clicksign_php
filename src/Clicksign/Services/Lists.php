<?php

namespace Clicksign\Services;


/**
 * Class Lists
 * @package Clicksign\Services
 */
class Lists extends Service
{
    /**
     * @var string
     */
    private $entity = 'lists';

    /**
     * @param $document_key
     * @param $signer_key
     * @param $message
     * @return mixed|string
     */
    public function addSigner($document_key, $signer_key, $message)
    {
        $data['body']['list'] = [
            'document_key' => $document_key,
            'signer_key' => $signer_key,
            'message' => $message,
            'sign_as' => 'sign'
        ];

        return $this->clicksign->doRequestCurl('POST', $this->entity, $data);
    }

    /**
     * @param $signer_key
     * @return mixed|string
     */
    public function removeSigner($signer_key)
    {
        $data['params'] = $signer_key;
        return $this->clicksign->doRequestCurl('DELETE', $this->entity, $data);
    }

}
