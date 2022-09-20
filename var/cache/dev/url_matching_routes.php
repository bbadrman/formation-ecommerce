<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/example' => [[['_route' => 'example', '_controller' => 'App\\Controller\\HelloController::example'], null, null, null, false, false, null]],
        '/' => [
            [['_route' => 'home', '_controller' => 'App\\Controller\\HomeController::home'], null, null, null, false, false, null],
            [['_route' => 'index', '_controller' => 'App\\Controller\\TestController::index'], null, null, null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/hello(?:/([^/]++))?(*:62)'
                .'|/test(?:/(\\d+))?(*:85)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        62 => [[['_route' => 'hello', 'nom' => 'world', '_controller' => 'App\\Controller\\HelloController::hello'], ['nom'], null, null, false, true, null]],
        85 => [
            [['_route' => 'test', 'age' => '0', '_controller' => 'App\\Controller\\TestController::test'], ['age'], ['GET' => 0, 'POST' => 1], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
