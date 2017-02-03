<?php

namespace Lucandrade\SecureHeaders;

class Bag
{

    protected $headers = [];

    protected $removed = [];

    protected $config = [
        'sts' => \Lucandrade\SecureHeaders\Headers\StrictTransportSecurity::class,
        'csp' => \Lucandrade\SecureHeaders\Headers\ContentSecurityPolicy::class,
        'xss' => \Lucandrade\SecureHeaders\Headers\XssProtection::class,
        'frame' => \Lucandrade\SecureHeaders\Headers\FrameOptions::class,
        'nosniff' => \Lucandrade\SecureHeaders\Headers\NoSniff::class,
        'dns' => \Lucandrade\SecureHeaders\Headers\DnsPrefetch::class,
        'poweredby' => \Lucandrade\SecureHeaders\Headers\PoweredBy::class,
    ];

    public function __construct(array $headers = [])
    {
        $this->set($headers);
    }

    public function get($header = false)
    {
        if (!$header) {
            return $this->headers;
        }

        return array_key_exists($header, $this->headers) ? $this->headers[$header] : false;
    }

    public function set($header, $value = null)
    {
        if (is_array($header)) {
            while (list($key, $value) = each($header)) {
                $this->set($key, $value);
            }
        }

        if (!empty($header) && is_string($header)) {
            if (array_key_exists($header, $this->config)) {
                $class = new $this->config[$header];
                $class->apply($value, $this);
            } else {
                $this->headers[$this->transformKey($header)] = $value;
            }
        }

        return $this;
    }

    protected function transformKey($key)
    {
        return $key;
    }

    public function remove($header = false)
    {
        if (!$header) {
            $removed = $this->removed;
            array_map(function ($h) {
                if ($this->get($h)) {
                    unset($this->headers[$h]);
                }

                if (function_exists('header_remove') && !headers_sent()) {
                    header_remove($h);
                }
            }, $removed);

            return $removed;
        }

        if (!in_array($header, $this->removed)) {
            $this->removed[] = $header;
        }

        if ($this->get($header)) {
            unset($this->headers[$header]);
        }
    }
}
