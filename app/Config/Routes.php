<?php

use App\Controllers\JobApplication;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */







$routes->get('/', 'Home::index');
$routes->add('/application', 'Application::index');
$routes->get('/jobapplications', 'JobApplication::index');
$routes->get('/jobapplication/pdf/(:num)', 'JobApplication::generatePDF/$1');
$routes->get('/joinpunjabpolice','JobApplication::vacancies');
$routes->match(['get','post'], '/apply/(:num)', 'JobApplication::apply/$1');
