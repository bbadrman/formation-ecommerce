<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    true, // $matchHost
    [ // $staticRoutes
        '/api' => [[['_route' => 'api_post_show', '_controller' => 'App\\Controller\\TestController::show'], null, ['GET' => 0, 'HEAD' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
            .'|(?:(?:[^./]*+\\.)++)(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:57)'
            .')|(?i:localhost)\\.(?'
                .'|/test(?:/(\\d+))?(*:100)'
            .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        57 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        100 => [
            [['_route' => 'test', 'age' => '0', '_controller' => 'App\\Controller\\TestController::test'], ['age'], ['GET' => 0, 'POST' => 1], ['http' => 0], false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
