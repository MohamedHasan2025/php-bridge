<?php

// Path to the application directory.
$pathsPath = realpath(__DIR__ . '/../app/Config/Paths.php');

// Ensure file exists
if (!file_exists($pathsPath)) {
    die('Paths.php not found. Please make sure app/Config/Paths.php exists.');
}

// Load the paths config
$paths = require $pathsPath;

// Bootstrapping is handled automatically by CodeIgniter 4.3+
// Run the application
$app = require rtrim($paths->systemDirectory, '\\/ ') . '/bootstrap.php';
$app->run();
