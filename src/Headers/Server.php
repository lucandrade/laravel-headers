<?php

namespace Lucandrade\SecureHeaders\Headers;

use Lucandrade\SecureHeaders\Bag;
use Lucandrade\SecureHeaders\Headers\HeaderBase;

class Server extends HeaderBase
{
    protected $key = 'Server';

    public function apply($value, Bag $bag)
    {
        $bag->remove($this->key);
    }
}
