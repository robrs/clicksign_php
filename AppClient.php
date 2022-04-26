<?php

require __DIR__ . "/vendor/autoload.php";


use Clicksign\ClientBase;
use Clicksign\Interfaces\iClicksign;
use Clicksign\Services\{Document, Lists, Notify, Signer, Batches, Account};

/**
 * Class Client
 */
class AppClient extends ClientBase implements iClicksign
{
    /**
     * @var Document
     */
    public $document;
    /**
     * @var Lists
     */
    public $list;
    /**
     * @var Signer
     */
    public $signer;
    /**
     * @var Batches
     */
    public $batch;

    /**
     * @var Notify
     */
    public $notify;
    /**
     * @var Account
     */
    public $account;

    /**
     * Clicksign constructor.
     * @param $accessToken
     * @param string|null $environment (Test or Production)
     */
    public function __construct($accessToken, $environment = null)
    {
        $this->document = new Document($this);
        $this->list = new Lists($this);
        $this->signer = new Signer($this);
        $this->batch = new Batches($this);
        $this->notify = new Notify($this);
        $this->account = new Account($this);

        $this->setAccessToken($accessToken);
        $this->setBaseUrl($environment);
    }

    /**
     * @param $file
     * @param $filePath
     * @param $fileName
     * @return mixed|string
     */
    public function uploadDocument($file, $filePath, $fileName)
    {
        return $this->document->upload($file, $filePath, $fileName);
    }

    /**
     * @param string $document_key
     * @return mixed|string
     */
    public function viewDocument($document_key)
    {
        return $this->document->view($document_key);
    }

    /**
     * @return mixed|string
     */
    public function listAllDocuments()
    {
        return $this->document->listAll();
    }

    /**
     * @param string $document_key
     * @return mixed|string
     */
    public function cancelDocument($document_key)
    {
        return $this->document->cancel($document_key);
    }

    /**
     * @param string $document_key
     * @return mixed|string
     */
    public function removeDocument($document_key)
    {
        return $this->document->delete($document_key);
    }

    /**
     * @param array $signer
     * @return mixed|string
     */
    public function createSigner($signer)
    {
        return $this->signer->create($signer);
    }

    /**
     * @param string $signer_key
     * @return mixed|string
     */
    public function removeSigner($signer_key)
    {
        return $this->signer->remove($signer_key);
    }

    /**
     * @param string $document_key
     * @param string $signer_key
     * @param string $message
     * @return mixed|string
     */
    public function createList($document_key, $signer_key, $message)
    {
        return $this->list->addSigner($document_key, $signer_key, $message);
    }

    /**
     * @param string $request_signature_key
     * @param string $message
     * @param null $url
     * @return mixed|string
     */
    public function notifyByEmail($request_signature_key, $message, $url = null)
    {
        return $this->notify->sendByEmail($request_signature_key, $message, $url);
    }

    /**
     * @param string $request_signature_key
     * @return mixed|string
     */
    public function notifyBySMS($request_signature_key)
    {
        return $this->notify->sendBySms($request_signature_key);
    }

    /**
     * @param string $request_signature_key
     * @return mixed|string
     */
    public function notifyByWhatsapp($request_signature_key)
    {
        return $this->notify->sendByWhatsApp($request_signature_key);
    }

    /**
     * @param array $batch
     * @return mixed|object
     */
    public function createBatches($batch)
    {
       return $this->batch->create($batch);
    }

    /**
     * @return mixed|object
     */
    public function getAccount()
    {
        return $this->account->getAccount();
    }
}
