<?php

namespace Lucandrade\SecureHeaders\Headers;

use Lucandrade\SecureHeaders\Bag;
use Lucandrade\SecureHeaders\Headers\HeaderBase;

class DnsPrefetch extends HeaderBase
{
    protected $key = 'X-DNS-Prefetch-Control';
}
