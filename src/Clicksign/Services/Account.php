<?php


namespace Clicksign\Services;

/**
 * Class Account
 * @package Clicksign\Services
 */
class Account extends Service
{
    /**
     * @var string
     */
    private $entity = 'accounts';

    /**
     * @return object
     */
    public function getAccount()
    {
        return $this->clicksign->doRequestCurl('GET', $this->entity);
    }
}
