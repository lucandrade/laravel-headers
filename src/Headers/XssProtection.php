<?php

namespace Lucandrade\SecureHeaders\Headers;

use Lucandrade\SecureHeaders\Bag;
use Lucandrade\SecureHeaders\Headers\HeaderBase;

class XssProtection extends HeaderBase
{
    protected $key = 'X-XSS-Protection';
}
