<?php

return [
    "wordpress" =>[
        "url" => env('WP_API_URL', ''),
        "user" => env('WP_API_USER', ''),
        "password" => env('WP_API_PASSWORD', ''),
    ],
    'pages' => [
        'home' => 'inicio',
        'associacio' => 'associacio',
        'fes-te-soci' => 'fes-te-soci',
        'home' => 'inicio',
    ],
    'sizes' => [
        'small' => 'square-small',
        'medium' => 'square-medium',
        'big' => 'square-big' 
    ],
    'image-max-size' => 3000000, //3 MB
    'email-alta-soci' => env('AIT_MAIL_ALTA', ''),
];
