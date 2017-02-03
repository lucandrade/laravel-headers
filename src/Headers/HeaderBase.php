<?php

namespace Lucandrade\SecureHeaders\Headers;

use Lucandrade\SecureHeaders\Bag;

class HeaderBase
{
    protected $key = 'X-XSS-Protection';

    public function apply($value, Bag $bag)
    {
        $bag->set($this->key, $value);
    }
}
