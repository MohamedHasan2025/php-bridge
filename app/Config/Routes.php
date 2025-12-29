<?php

use CodeIgniter\Router\RouteCollection;

$routes = \Config\Services::routes();

/**
 * @var RouteCollection $routes
 */
    $routes->get('/', 'Home::index');

    // Proxy endpoint: forwards requests to another internal or external endpoint.
    // Usage examples:
    //  - GET  /proxy?url=/api/target
    //  - POST /proxy with header X-Target-URL: /api/submit
    $routes->match(['get', 'post', 'put', 'delete'], 'proxy', 'Proxy::forward');

    $routes->get('/sendJson', 'ApiController::sendJson');

    $routes->post('get-availabilities', 'ApiController::sendAvailability');
    $routes->get('get-availabilities', 'ApiController::sendAvailability'); // optional for GET

    $routes->post('/reserve', 'ApiController::reserveAvailability');

    $routes->post('/cancel-reservation', 'ApiController::cancelReservation');

    $routes->post('/book', 'ApiController::bookReservation');
    
    $routes->post('/cancel-booking', 'ApiController::cancelReservation');

