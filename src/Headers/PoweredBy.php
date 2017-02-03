<?php

namespace Lucandrade\SecureHeaders\Headers;

use Lucandrade\SecureHeaders\Bag;
use Lucandrade\SecureHeaders\Headers\HeaderBase;

class PoweredBy extends HeaderBase
{
    protected $key = 'X-Powered-By';

    public function apply($value, Bag $bag)
    {
        $bag->remove($this->key);
    }
}
