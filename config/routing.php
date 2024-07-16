<?php

return [
    'paths' => [

        // Authentication API Routes
        [
            'path' => base_path('routes/authentication/routes.php'),
            'middleware' => ['api'],
            'prefix' => 'api/auth',
        ],
    ],
];
