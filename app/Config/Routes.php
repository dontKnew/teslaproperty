<?php

namespace Config;

$routes = Services::routes();

if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers' );
$routes->setDefaultController('HomeController' );
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
//$routes->set404Override(function(){
//    return view("page_not_found");
//});


$routes->group('admin', function($routes){

    /*Admin Login Routes*/
        $routes->get('login', 'Admin\LoginController::index', ['as'=>"admin/login", "filter"=>"csrf"]);
        $routes->post('login', 'Admin\LoginController::adminLogin', ["as"=>"admin/login", "filter"=>"csrf"]);
        $routes->get('logout', 'Admin\LoginController::adminLogout', ['as'=>'admin/logout']);

        $routes->match(['post', 'get'],'change-password', 'Admin\LoginController::changePassword' , ["as"=>"admin/change-password", "filter"=>"admin"]);
        $routes->get('profile', 'Admin\LoginController::adminProfile', ["as"=>'admin/profile', "filter"=>"admin"]);
        $routes->post('profile', 'Admin\LoginController::updateProfile', ["as"=>'admin/profile', "filter"=>"admin"]);
        $routes->get('register', 'Admin\RegisterController::index', ["as"=>"admin/register"]);

    /*dashboard*/
        $routes->get('dashboard', 'Admin\DashboardController::index', ["as"=>"admin/dashboard", "filter"=>"admin"]);

    /* StateController*/
        $routes->match( (['post','get']), 'state', 'Admin\StateController::index' , ["as"=>"admin/state", "filter"=>"admin"]);
        $routes->match(['get', 'post'],'state/add', 'Admin\StateController::add' , ["as"=>"admin/state/add", "filter"=>"admin"]);
        $routes->match(['post','get'],'state/update/(:num)', 'Admin\StateController::update/$1' , ["as"=>"admin/state/update","filter"=>"admin"]);
        $routes->get('state/(:num)', 'Admin\StateController::delete/$1' , ["as"=>"admin/state/delete", "filter"=>"admin"]);

    /* CityController*/
        $routes->match( (['post','get']), 'city', 'Admin\CityController::index' , ["as"=>"admin/city", "filter"=>"admin"]);
        $routes->match(['get', 'post'],'city/add', 'Admin\CityController::add' , ["as"=>"admin/city/add", "filter"=>"admin"]);
        $routes->match(['post','get'],'city/update/(:num)', 'Admin\CityController::update/$1' , ["as"=>"admin/city/update","filter"=>"admin"]);
        $routes->get('city/(:num)', 'Admin\CityController::delete/$1' , ["as"=>"admin/city/delete", "filter"=>"admin"]);


        /* ApartmentController*/
        $routes->match( (['post','get']), 'apartment', 'Admin\ApartmentController::index' , ["as"=>"admin/apartment", "filter"=>"admin"]);
        $routes->match(['get', 'post'],'apartment/add', 'Admin\ApartmentController::add' , ["as"=>"admin/apartment/add", "filter"=>"admin"]);
        $routes->match(['post','get'],'apartment/update/(:num)', 'Admin\ApartmentController::update/$1' , ["as"=>"admin/apartment/update","filter"=>"admin"]);
        $routes->get('apartment/(:num)', 'Admin\ApartmentController::delete/$1' , ["as"=>"admin/apartment/delete", "filter"=>"admin"]);

});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
