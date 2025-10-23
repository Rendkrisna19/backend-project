<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Tambahkan origin FE kamu di sini
    'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173'],

    'allowed_methods' => ['*'],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,

    // Tidak butuh credentials kalau pakai Bearer token
    'supports_credentials' => false,
];
