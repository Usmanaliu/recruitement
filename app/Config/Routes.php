<?php

use App\Controllers\JobApplication;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */







$routes->get('/', 'JobApplication::vacancies');
$routes->add('/application', 'Application::index');
$routes->get('/jobapplications', 'JobApplication::index');
$routes->get('/jobapplication/pdf/(:num)', 'JobApplication::generatePDF/$1');
$routes->get('/joinpunjabpolice', 'JobApplication::vacancies');

$routes->match(['get', 'post'], '/uploadimage', 'JobApplication::uploadedImage');
$routes->get('/get-requirements/(:num)', 'JobApplication::getRequirements/$1');
$routes->match(['get', 'post'], '/apply/(:num)', 'JobApplication::apply/$1');


$routes->post('/save-personal-info', 'JobApplication::savePersonalInfo');
$routes->get('/forcompletion/(:num)', 'JobApplication::checkCompletion/$1');
$routes->post('/submit-application/(:num)', 'JobApplication::submitApplication/$1');


$routes->match(['get', 'post'], '/informationForm/(:num)', 'JobApplication::form_info/$1');
$routes->post('/candidate-genInfo-save', 'JobApplication::genInfoSave');

$routes->match(['get', 'post'], '/educationFrom/(:num)', 'JobApplication::eduForm/$1');
$routes->match(['get', 'post'], '/educationFromentry', 'JobApplication::add');

$routes->get('education/delete/(:num)/(:num)', 'JobApplication::delete/$1/$2');


$routes->match(['get', 'post'], '/application-page', 'JobApplication::applicationPage');

$routes->match(['get', 'post'], '/relative-form-data/(:num)', 'JobApplication::relativeFormData/$1');
$routes->match(['get', 'post'], '/relative_save', 'JobApplication::relativesFormSave');


$routes->get('/experianceInfoForm/(:num)', 'JobApplication::experianceFromView/$1');
$routes->match(['get', 'post'], '/experienceSave', 'JobApplication::ExpSave');

$routes->match(['get', 'post'], '/addressForm/(:num)', 'JobApplication::AddInfo/$1');


$routes->get('candidates/edit', 'Candidates::edit');
$routes->get('candidates/getPoliceStations', 'District::getPoliceStations');
$routes->post('candidates/update', 'Candidates::update');
$routes->match(['get', 'post'], '/testimonialinfo/(:num)', 'JobApplication::testimonial/$1');

$routes->match(['get', 'post'], 'SearchApplication/(:num)', 'JobApplication::index/$1');


$routes->get('/dowloadApplication/(:num)', 'JobApplication::download/$1');





// admin routes
$routes->match(['GET', 'POST'], 'joinpunjabpolice/admin/login-for-admin', 'AdminController::login');

$routes->group('joinpunjabpolice/admin',['filter'=> 'auth'], function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('users-list', 'AdminController::usersList');
    $routes->match(['get','post'],'users', 'AdminController::fetchUsers'); // API for DataTables
    $routes->get('settings', 'AdminController::settings');
    $routes->get('create-job', 'AdminController::createJob');
    $routes->get('candidates-list', 'AdminController::candList');
    $routes->get('logout', 'AdminController::logout');
    $routes->match(['GET', 'POST'], 'create-user', 'AdminController::createUser');
});
