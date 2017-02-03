<?php

namespace Lucandrade\SecureHeaders\Headers;

use Lucandrade\SecureHeaders\Bag;
use Lucandrade\SecureHeaders\Headers\HeaderBase;

class StrictTransportSecurity extends HeaderBase
{
    protected $key = 'Strict-Transport-Security';
}
