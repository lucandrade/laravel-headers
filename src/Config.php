<?php

namespace Lucandrade\SecureHeaders;

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
        return include(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'headers.php');
    }
}
