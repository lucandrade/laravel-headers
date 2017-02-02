<?php

return [
    'add' => [
        'hsts' => 'Strict-Transport-Security: max-age=31536000 ; includeSubDomains',
        'csp' => 'Content-Security-Policy: script-src \'self\'',
        'xss' => 'X-XSS-Protection: 1; mode=block',
        'frame' => 'X-Frame-Options: sameorigin',
        'nosniff' => 'X-Content-Type-Options: nosniff',
        'dns' => 'X-DNS-Prefetch-Control: off',
    ],
    'disabled' => [
        'powered' => 'X-Powered-By'
    ],
];
