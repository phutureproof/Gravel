<?php

return [
	'GET'  => [
			'/'           => 'pagesController::home',
			'/page/(num)' => 'pagesController::home'
	],
	'POST' => [
			'/'           => 'pagesController::home',
			'/page/(num)' => 'pagesController::home'
	]
];