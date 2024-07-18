<?php

return [
    'paths' => [

        // Authentication API Routes
        [
            'path' => base_path('routes/authentication/routes.php'),
            'middleware' => ['api'],
            'prefix' => 'api/auth',
        ],

        // Author API Routes
        [
            'path' => base_path('routes/author/routes.php'),
            'middleware' => ['api', 'auth:api'],
            'prefix' => 'api/authors',
        ],

        // Book API Routes
        [
            'path' => base_path('routes/book/routes.php'),
            'middleware' => ['api', 'auth:api'],
            'prefix' => 'api/books',
        ],
    ],
];
