<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Visiteur');
$routes->setDefaultMethod('accueil');
$routes->setTranslateURIDashes(false);
//$routes->set404Override();
// Would execute the show404 method of the App\Errors class
$routes->set404Override(function( $message = null )
{
    $data = [
        'title' => '404 - Page not found',
        'message' => $message,
    ];
    echo view('my404', $data);
});
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Visiteur::accueil');
$routes->get('Visiteur/voir_un_produit/(:num)', 'Visiteur::prodByIdBis/$1');
// $routes->get('jeux/(:any)', 'Visiteur::prodBySlug/$1');
$routes->get('game/(:any)/(:any)', 'Visiteur::prodBySlug/$2');


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
