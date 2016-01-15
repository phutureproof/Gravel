<?php

use Gravel\Core\Router;

// encapsulation
function gravelRoutes()
{
	$routes = [
		'GET'  => [
			'/'                => 'pagesController::home',

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

	Router::createCRUD($routes, '/admin/users', 'usersAdminController');

	return $routes;
}

return gravelRoutes();