<?php

namespace Clicksign\Services;

/**
 * Class Document
 */
class Document extends Service
{
    /**
     * @var string
     */
    private $entity = 'documents';

    /**
     * @return mixed|string
     */
    public function listAll()
    {
        return $this->clicksign->doRequestCurl('GET', $this->entity, []);
    }

    /**
     * @param $file
     * @param $filePath
     * @param $fileName
     * @return mixed|string
     */
    public function upload($file, $filePath, $fileName)
    {
        $file = file_get_contents($file);
        $fileB64 = base64_encode($file);
        $deadline_at = date('Y-m-d H:i:s', strtotime("+89 days")); // 90 dias corridos a partir da data do upload

        $data['body']['document'] = [
            'path' => '/' . $filePath . '/' . $fileName,
            'content_base64' => 'data:application/pdf;base64,' . $fileB64,
            'deadline_at' => $deadline_at
        ];

        return $this->clicksign->doRequestCurl('POST', $this->entity, $data);
    }

    /**
     * @param string $document_key
     * @return mixed|string
     */
    public function view($document_key)
    {
        $data['params'] = $document_key;
        return $this->clicksign->doRequestCurl('GET', $this->entity, $data);
    }

    /**
     * @param string $document_key
     * @return mixed|string
     */
    public function finalize($document_key)
    {
        $data['params'] = $document_key;
        return $this->clicksign->doRequestCurl('PATCH', $this->entity, $data);
    }

    /**
     * @param string $document_key
     * @return mixed|string
     */
    public function cancel($document_key)
    {
        $data['params'] = $document_key . '/cancel';
        return $this->clicksign->doRequestCurl('PATCH', $this->entity, $data);
    }

    /**
     * @param string $document_key
     * @return object
     */
    public function delete($document_key)
    {
        $data['params'] = $document_key;
        return $this->clicksign->doRequestCurl('DELETE', $this->entity, $data);
    }

}
