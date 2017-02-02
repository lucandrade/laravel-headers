<?php

namespace Lucandrade\Headers;

class Config
{

    public static function get()
    {
        $config = config("headers");

    	if(!empty($config)) {
    		return $config;
    	}

        $config = static::getFromFile();

        return is_array($config) ? $config : [];
    }

    private static function getFromFile()
    {
        return require_once(__DIR__ . 'config' . DIRECTORY_SEPARATOR . 'headers.php');
    }
}
