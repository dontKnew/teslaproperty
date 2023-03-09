
/* ApartmentController*/
$routes->match( (['post','get']), 'apartment', 'Admin\ApartmentController::index' , ["as"=>"admin/apartment", "filter"=>"admin"]);
$routes->match(['get', 'post'],'apartment/add', 'Admin\ApartmentController::add' , ["as"=>"admin/apartment/add", "filter"=>"admin"]);
$routes->match(['post','get'],'apartment/update/(:num)', 'Admin\ApartmentController::update/$1' , ["as"=>"admin/apartment/update","filter"=>"admin"]);
$routes->get('apartment/(:num)', 'Admin\ApartmentController::delete/$1' , ["as"=>"admin/apartment/delete", "filter"=>"admin"]);