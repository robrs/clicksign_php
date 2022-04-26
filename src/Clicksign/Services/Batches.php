<?php


namespace Clicksign\Services;

/**
 * Class Batches
 * @package Clicksign\Services
 */
class Batches extends Service
{
    /**
     * @var string
     */
    private $entity = 'batches';

    /**
     * @param array $batch
     * @return object
     */
    public function create($batch)
    {

        $data['body'] = [
            'batch' => $batch
        ];

        return $this->clicksign->doRequestCurl('POST', $this->entity, $data);
    }
}
