<?php

use Gravel\Core\Router;

// encapsulation
function gravelRoutes()
{
	$routes = [
		'GET'  => [
			'/'                => 'pagesController::home',
			'/tests'           => 'testController::index',

			// standard admin routes
			'/admin'           => 'loginController::index',
			'/admin/dashboard' => 'adminDashboardController::index',
			'/admin/logout'    => 'loginController::logout',

		],
		'POST' => [
			'/'            => 'pagesController::home',

			// standard admin routes
			'/admin/login' => 'loginController::login'
		]
	];

	// generate crud based paths for admin side
	Router::createCRUD($routes, '/admin/users', 'usersAdminController');
	Router::createCRUD($routes, '/admin/blog', 'blogAdminController');
	Router::createCRUD($routes, '/admin/brands', 'brandAdminController');

	return $routes;
}

return gravelRoutes();