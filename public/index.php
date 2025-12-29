<?php

// Path to the system directory.
$systemPath = realpath(__DIR__ . '/../vendor/codeigniter4/framework/system');

// Path to the app directory.
$applicationPath = realpath(__DIR__ . '/../app');

// Path to the writable directory.
$writablePath = realpath(__DIR__ . '/../writable');

// Load Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Boot CodeIgniter
$paths = new \Config\Paths();
$app = require_once $systemPath . '/bootstrap.php';

// Run the application
$app->run();
