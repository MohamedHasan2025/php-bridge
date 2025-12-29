<?php

/**
 * --------------------------------------------------------------------
 * Front Controller for CodeIgniter 4
 * --------------------------------------------------------------------
 *
 * This is the entry point for all requests to your application.
 */

// Path to the system directory
$systemPath = realpath(__DIR__ . '/../vendor/codeigniter4/framework/system');
if (!is_dir($systemPath)) {
    die('System folder not found. Did you run composer install?');
}

// Path to the application directory
$applicationPath = realpath(__DIR__ . '/../app');

// Path to the writable directory
$writablePath = realpath(__DIR__ . '/../writable');

// Define FCPATH
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Load Composer autoloader
require FCPATH . '/../vendor/autoload.php';

// Load the framework
require $systemPath . '/bootstrap.php';

// Run the application
$app->run();
