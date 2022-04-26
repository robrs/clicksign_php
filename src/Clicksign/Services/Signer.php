<?php

namespace Clicksign\Services;

/**
 * Class Signers
 */
class Signer extends Service
{
    /**
     * @var string
     */
    private $entity = 'signers';

    /**
     * @param $signer
     * @return mixed|string
     */
    public function create($signer)
    {
        $data['body'] = [
            'signer' => [
                'name' => $signer['name'],
                'phone_number' => $signer['phone_number'],
                'email' => $signer['email'],
                'documentation' => $signer['documentation'],
                'birthday' => $signer['birthday'],
                'auths' => $signer['auths'],
                'has_documentation' => true,
                'selfie_enabled' => false,
                'handwritten_enabled' => false,
                'official_document_enabled' => false,
                'liveness_enabled' => false
            ]
        ];

        return $this->clicksign->doRequestCurl('POST', $this->entity, $data);
    }

    /**
     * @param $signer_key
     * @return mixed|string
     */
    public function view($signer_key)
    {
        $data['params'] = $signer_key;
        return $this->clicksign->doRequestCurl('POST', $this->entity, $data);
    }

    /**
     * @param $signer_key
     * @return mixed|string
     */
    public function remove($signer_key)
    {
        $data['params'] = $signer_key;
        return $this->clicksign->doRequestCurl('DELETE', $this->entity, $data);
    }

}
