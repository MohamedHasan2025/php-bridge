<?php

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure ENVIRONMENT is defined
defined('ENVIRONMENT') || define('ENVIRONMENT', 'production');

// Load the paths config
require FCPATH . '../app/Config/Paths.php';

$paths = new Config\Paths();

// Load the framework bootstrap
require rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
