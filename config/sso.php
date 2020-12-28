<?php

return [
    'url' => 'https://sso.trans7.co.id',

    'client_id' => env('SSO_CLIENT_ID'),
    'client_secret' => env('SSO_CLIENT_SECRET'),
    'redirect' => getenv('APP_URL') . '/callback',

    'logout_frame' => getenv('APP_URL') . '/logout',

    'usermap' => [
        'id',
        'name',
        'email',
        'nik',
        'nik_lama',
        'internal'
    ],
];