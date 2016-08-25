<?php


/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 07.12.15
 * Time: 22:08
 */
class GoogleAbstractFactory extends SearchProviderAbstractFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getInstance()
    {
        $searchConfigures = $this->config->google;

        $google = new Google($searchConfigures);

        return $google;
    }
}