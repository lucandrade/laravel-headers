<?php

namespace Lucandrade\SecureHeaders;

class Bag
{

    protected $headers = [];

    public function __construct(array $config = [])
    {
        if (array_key_exists('add', $config) && is_array($config['add'])) {
            $this->add($config['add']);
        }

        if (array_key_exists('disabled', $config) && is_array($config['disabled'])) {
            $this->remove($config['disabled']);
        }
    }

    public function get($header = false)
    {
        if (!$header) {
            return $this->headers;
        }

        return array_key_exists($header, $this->headers) ? $this->headers[$header] : false;
    }

    public function set($header)
    {
        list($key, $value) = explode(':', $header);

        if (!empty($key) && !empty($value)) {
            $this->headers[$this->transformKey($key)] = $value;
        }

        return $this;
    }

    protected function transformKey($key)
    {
        return $key;
    }

    public function add($header)
    {
        if (is_array($header)) {
            array_map(function ($h) {
                $this->set($h);
            }, $header);
        }

        if (is_string($header)) {
            $this->set($header);
        }
    }

    public function remove($header)
    {
        if (is_array($header)) {
            array_map(function ($h) {
                $this->remove($h);
            }, $header);
        }

        if (is_string($header)) {
            if ($this->get($header)) {
                unset($this->headers[$header]);
            }

            if (function_exists('header_remove') && !headers_sent()) {
                header_remove($header);
            }
        }
    }
}
