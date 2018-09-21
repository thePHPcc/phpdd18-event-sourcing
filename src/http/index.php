<?php
require __DIR__ . '/../../vendor/autoload.php';

session_name('checkout_demo_session');
session_start();

set_error_handler(
    function (int $errno, string $errstr, string $errfile = '', int $errline = 0) {
        throw new ErrorException($errstr, $errno, 1, $errfile, $errline);
    }
);

// Instantiate the app
$settings = require __DIR__ . '/settings.php';
$app = new \Slim\App($settings);

require __DIR__ . '/dependencies.php';

// Register routes
require __DIR__ . '/routes.php';

// Run app
$app->run();
