<?php

return [
    'sts' => 'max-age=31536000 ; includeSubDomains',
    'csp' => 'script-src \'self\'',
    'xss' => '1; mode=block',
    'frame' => 'sameorigin',
    'nosniff' => 'nosniff',
    'dns' => 'off',
    'poweredby' => '',
    'server' => false,
];
