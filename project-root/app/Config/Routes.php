<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Home::index');
$routes->get('/livros', 'Livros::index');
$routes->post('/salva-contato', 'Mensagens::salvar');

$routes->get('LivrosApi/new',             'LivrosApi::new');
$routes->post('LivrosApi',                'LivrosApi::create');
$routes->get('LivrosApi',                 'LivrosApi::index');
$routes->get('LivrosApi/(:segment)',      'LivrosApi::show/$1');
$routes->get('LivrosApi/(:segment)/edit', 'LivrosApi::edit/$1');
$routes->put('LivrosApi/(:segment)',      'LivrosApi::update/$1');
$routes->patch('LivrosApi/(:segment)',    'LivrosApi::update/$1');
$routes->delete('LivrosApi/(:segment)',   'LivrosApi::delete/$1');


//Authentication

$routes->get('auth/sigin', 'Auth::sigin');
$routes->get('auth/registration', 'Auth::registration');
$routes->get('auth/recover-password', 'Auth::recoverPassword');
$routes->post('auth/save-registration', 'Auth::saveRegistration');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');
$routes->post('auth/reset-password', 'Auth::resetPassword');

//Email
$routes->get("send-mail", "Email::sendMail");

//Logged in area

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
    //Dashboard
    $routes->get('dashboard', 'Dash::index');
    $routes->get('dashboard/livros', 'Dash::livros');
    $routes->get('dashboard/contatos', 'Dash::contatos');

    //Users
    $routes->post('user/update', 'User::updateProfile');
    $routes->post('user/update-password', 'User::updatePassword');

    //Livros
    $routes->post('livros/salvar', 'Livros::salvar');
    $routes->post('livros/excluir', 'Livros::excluir');

    //Mensagens
    $routes->post('mensagens/excluir', 'Mensagens::excluir');
    $routes->post('mensagens/marcar-respondido', 'Mensagens::marcarRespondida');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
