<?php

// Path to the system directory
$systemPath = realpath(__DIR__ . '/../vendor/codeigniter4/framework/system');
if (!is_dir($systemPath)) {
    die('System folder not found. Did you run composer install?');
}

// Path to the application directory
$applicationPath = realpath(__DIR__ . '/../app');

// Path to writable directory
$writablePath = realpath(__DIR__ . '/../writable'); 

// Define FCPATH
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Load Composer autoloader
require FCPATH . '/../vendor/autoload.php';

// Load CodeIgniter
$paths = new \Config\Paths();
$app = \Config\Services::request(); // framework bootstrapped automatically
$app->run();
