<?php

namespace Lucandrade\Headers;

use Closure;
use Lucandrade\Headers\Config;
use Lucandrade\Headers\Bag;

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
        array_map(function ($header) use ($response) {
            $response->headers->remove($header);
        }, $this->headers()->disabled());
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

        $this->add($response);
        $this->remove($response);

        return $response;
    }
}
