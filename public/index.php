<?php

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

require FCPATH . '../vendor/autoload.php';

require FCPATH . '../app/Config/Paths.php';

$paths = new Config\Paths();

require rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
