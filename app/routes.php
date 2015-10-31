<?php

return [
	'GET'  => [
		'/'    => 'pagesController::home',
		'/dev' => 'pagesController::dev'
	],
	'POST' => [
		'/dev' => 'pageController::dev'
	]
];