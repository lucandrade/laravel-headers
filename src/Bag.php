<?php

namespace Lucandrade\Headers;

class Bag
{

    protected $headers = [];
    protected $disabled = [];

    public function __construct(array $config = [])
    {
        if (array_key_exists('add', $config) && is_array($config['add'])) {
            $this->add($config['add']);
        }

        if (array_key_exists('disabled', $config) && is_array($config['disabled'])) {
            $this->disable($config['disabled']);
        }
    }

    public function get($header = null, $disabled = false)
    {
        $headers = $disabled ? $this->disabled : $this->headers;

        if (!$header) {
            return $headers;
        }

        return array_key_exists($header, $headers) ? $headers[$header] : false;
    }

    public function disabled()
    {
        return $this->get(null, true);
    }

    protected function transformKey($key)
    {
        return $key;
    }

    public function add($header)
    {
        if (is_array($header)) {
            array_map(function ($h) {
                $this->add($h);
            }, $header);
        }

        if (is_string($header)) {
            list($key, $value) = explode(':', $header);

            if (!empty($key) && !empty($value)) {
                $this->headers[$this->transformKey($key)] = $value;
            }
        }
    }

    public function remove($header)
    {
        if (array_key_exists($header, $this->headers)) {
            unset($this->headers[$header]);
        }
    }

    public function disable($header)
    {
        if (is_array($header)) {
            array_map(function ($h) {
                $this->disable($h);
            }, $header);
        }

        if (is_string($header)) {
            $this->remove($header);

            if (!in_array($header, $this->disabled)) {
                $this->disabled[] = $header;
            }
        }
    }
}
