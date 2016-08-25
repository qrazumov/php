<?php

/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 07.12.15
 * Time: 22:24
 */
class Config
{
    private static $_instance = null;

    protected $configures;

    private function __construct()
    {
        $this->configures = include 'Configure/main.php';
    }

    private function __clone()
    {

    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __get($name)
    {
        return $this->configures[$name];
    }
}