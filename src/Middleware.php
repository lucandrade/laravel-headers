<?php

namespace Lucandrade\SecureHeaders;

use Closure;
use Lucandrade\SecureHeaders\Config;
use Lucandrade\SecureHeaders\Bag;

class Middleware
{
    protected $headers;

    protected function headers()
    {
        if (!$this->headers) {
            $this->headers = new Bag(Config::get());
        }

        return $this->headers;
    }

    protected function remove($response)
    {
        $removed = $this->headers()->remove();

        array_map(function ($header) use ($response) {
            $response->headers->remove($header);
        }, $removed);
    }

    protected function add($response)
    {
        $headers = $this->headers()->get();

        while (list($key, $value) = each($headers)) {
            $response->headers->set($key, $value);
        }
    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $this->remove($response);
        $this->add($response);

        return $response;
    }
}
