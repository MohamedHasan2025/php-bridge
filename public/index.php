<?php

/**
 * --------------------------------------------------------------------
 * Front Controller for CodeIgniter 4
 * --------------------------------------------------------------------
 * This is the entry point for all requests to your application.
 * It bootstraps the framework and runs the application.
 */

// Path to the application directory.
$pathsPath = realpath(__DIR__ . '/../app/Config/Paths.php');

if (!file_exists($pathsPath)) {
    die('Paths.php not found. Make sure app/Config/Paths.php exists.');
}

// Load the Paths configuration
$paths = require $pathsPath;

// Ensure the autoloader is loaded
require __DIR__ . '/../vendor/autoload.php';

// Load the framework bootstrap
$app = require $paths->systemDirectory . '/bootstrap.php';

// Run the application
$app->run();
