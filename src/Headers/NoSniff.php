<?php

namespace Lucandrade\SecureHeaders\Headers;

use Lucandrade\SecureHeaders\Bag;
use Lucandrade\SecureHeaders\Headers\HeaderBase;

class NoSniff extends HeaderBase
{
    protected $key = 'X-Content-Type-Options';
}
