<?php

namespace Clicksign\Services;

use AppClient;

/**
 * Class Service
 */
class Service
{
    /**
     * @var AppClient
     */
    protected $clicksign;

    /**
     * Service constructor.
     * @param AppClient $clicksign
     */
    public function __construct(AppClient $clicksign)
    {
        $this->clicksign = $clicksign;
    }

}
