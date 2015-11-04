<?php

return [
	'GET'  => [
        '/'                    => 'pagesController::home',
        '/page/(num)'          => 'pagesController::home',
        '/page/(num)/(string)' => 'pagesController::home'
	],
	'POST' => [
        '/' => 'pagesController::home'
	]
];