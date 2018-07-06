<?php

namespace App;

class Config
{
    private static $_instance = null;
    private $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/config.php';
    }

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new Config();
        }

        return self::$_instance;
    }

    public function get($path, $default = null)
    {
        $path = explode('.', $path);
        $config = $this->config;

        foreach ($path as $key) {
            if (isset($config[$key])) {
                $config = $config[$key];
            } else {
                return $default;
            }
        }

        return $config;
    }
}