<?php

$router = $di->getRouter();

// Define your routes here

$router->handle();

$router->add(
    '/Jakinson',
    [
        'controller' => 'designer',
        'action'     => 'search',
	3	     => ['id' => '1'],
    ]
);

$router->add(
    '/Hubbs',
    [
        'controller' => 'designer',
        'action'     => 'search',
	3	     => ['id' => '2'],
    ]
);
