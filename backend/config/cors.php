<?php

return [
	/*
	|--------------------------------------------------------------------------
	| CORS Paths
	|--------------------------------------------------------------------------
	|
	| These paths will be treated as CORS-enabled for the application. Typically
	| API endpoints are included here.
	|
	*/
	'paths' => ['api/*', 'sanctum/csrf-cookie'],

	/*
	|--------------------------------------------------------------------------
	| Allowed Origins
	|--------------------------------------------------------------------------
	|
	| Add your frontend origin used during development so the browser won't be
	| blocked by the CORS policy. Keep this specific for production.
	|
	*/
	'allowed_origins' => ['http://localhost:5173'],

	'allowed_origins_patterns' => [],
	'allowed_methods' => ['*'],
	'allowed_headers' => ['*'],
	'exposed_headers' => [],
	'max_age' => 0,
	'supports_credentials' => false,
];