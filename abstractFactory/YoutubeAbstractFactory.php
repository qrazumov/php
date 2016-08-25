<?php

/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 07.12.15
 * Time: 22:14
 */
class YoutubeAbstractFactory extends SearchProviderAbstractFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getInstance()
    {
        $youtubeConfigures = $this->config->youtube;

        $youtube = new Youtube();

        return $youtube;
    }
}