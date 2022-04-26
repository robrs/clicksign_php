<?php

namespace Clicksign\Interfaces;

/**
 * Interface iClicksign
 */
interface iClicksign
{
    /**
     * @param $file
     * @param $filePath
     * @param $fileName
     * @return mixed
     */
    public function uploadDocument($file, $filePath, $fileName);

    /**
     * @param string $document_key
     * @return mixed
     */
    public function viewDocument($document_key);

    /**
     * @return mixed
     */
    public function listAllDocuments();

    /**
     * @param string $document_key
     * @return mixed
     */
    public function cancelDocument($document_key);

    /**
     * @param string $document_key
     * @return mixed
     */
    public function removeDocument($document_key);

    /**
     * @param array $signer
     * @return mixed
     */
    public function createSigner($signer);

    /**
     * @param string $signer_key
     * @return mixed
     */
    public function removeSigner($signer_key);

    /**
     * @param string $document_key
     * @param string $signer_key
     * @param string $message
     * @return mixed
     */
    public function createList($document_key, $signer_key, $message);

    /**
     * @param string $request_signature_key
     * @param string $message
     * @param string $url
     * @return mixed
     */
    public function notifyByEmail($request_signature_key, $message, $url);

    /**
     * @param string $request_signature_key
     * @return mixed
     */
    public function notifyBySMS($request_signature_key);

    /**
     * @param string $request_signature_key
     * @return mixed
     */
    public function notifyByWhatsapp($request_signature_key);

    /**
     * @param $batch
     * @return mixed
     */
    public function createBatches($batch);

    /**
     * @return mixed
     */
    public function getAccount();

}
