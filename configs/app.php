<?php
$config['app'] = [
    'services' => [
        HtmlHelper::class
    ],
    'routeMiddleware' => [
        'quan-ly-tai-khoan' => AuthMiddleware::class,
        'profile' => AuthMiddleware::class,
        'admin' => AuthMiddlewareAdmin::class,
        'admin/account' => AuthMiddlewareAdmin::class,
    ],
    'globalMiddleware' => [
        // ParamsMiddleware::class
    ],
    'boot' => [
        AppServiceProvider::class,
    ]
];
?>