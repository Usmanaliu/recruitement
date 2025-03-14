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

$routes->match(['get','post'],'/uploadimage', 'JobApplication::uploadedImage');
$routes->get('/get-requirements/(:num)', 'JobApplication::getRequirements/$1');
$routes->match(['get','post'], '/apply/(:num)', 'JobApplication::apply/$1');


$routes->post('/save-personal-info', 'JobApplication::savePersonalInfo');
$routes->get('/check-completion/(:num)', 'JobApplication::checkCompletion/$1');
$routes->post('/submit-application/(:num)', 'JobApplication::submitApplication/$1');


$routes->match(['get','post'],'/informationForm', 'JobApplication::form_info');
$routes->post('/candidate-genInfo-save', 'JobApplication::genInfoSave');

$routes->match(['get','post'],'/educationFrom', 'JobApplication::eduForm');
$routes->match(['get','post'],'/educationFromentry', 'JobApplication::add');

$routes->get('education/delete/(:num)/(:num)', 'JobApplication::delete/$1/$2');


$routes->match(['get','post'],'/application-page', 'JobApplication::applicationPage');

$routes->match(['get','post'],'/relative-form-data', 'JobApplication::relativeFormData');
$routes->match(['get','post'],'/relative_save', 'JobApplication::relativesFormSave');


$routes->get('/experianceInfoForm','JobApplication::experianceFromView');
$routes->match(['get','post'],'/experienceSave', 'JobApplication::ExpSave');

