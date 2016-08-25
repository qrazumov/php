<?php

/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 07.12.15
 * Time: 22:02
 */
abstract class SearchProviderAbstractFactory
{
    protected $config;

    public function __construct()
    {
        $this->config = Config::getInstance();
    }

    abstract public function getInstance();
}