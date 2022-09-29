<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin/category/create' => [[['_route' => 'category_create', '_controller' => 'App\\Controller\\CategoryController::create'], null, null, null, false, false, null]],
        '/example' => [[['_route' => 'example', '_controller' => 'App\\Controller\\HelloController::example'], null, null, null, false, false, null]],
        '/' => [
            [['_route' => 'home', '_controller' => 'App\\Controller\\HomeController::home'], null, null, null, false, false, null],
            [['_route' => 'index', '_controller' => 'App\\Controller\\TestController::index'], null, null, null, false, false, null],
        ],
        '/admin/product/create' => [[['_route' => 'products_create', '_controller' => 'App\\Controller\\ProductController::create'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/admin/category/([^/]++)/edit(*:198)'
                .'|/hello(?:/([^/]++))?(*:226)'
                .'|/([^/]++)(?'
                    .'|(*:246)'
                    .'|/([^/]++)(*:263)'
                .')'
                .'|/admin/product/([^/]++)/edit(*:300)'
                .'|/test(?:/(\\d+))?(*:324)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        198 => [[['_route' => 'category_edit', '_controller' => 'App\\Controller\\CategoryController::edit'], ['id'], null, null, false, false, null]],
        226 => [[['_route' => 'hello', 'nom' => 'world', '_controller' => 'App\\Controller\\HelloController::hello'], ['nom'], null, null, false, true, null]],
        246 => [[['_route' => 'product_category', '_controller' => 'App\\Controller\\ProductController::category'], ['slug'], null, null, false, true, null]],
        263 => [[['_route' => 'product_show', '_controller' => 'App\\Controller\\ProductController::show'], ['category_slug', 'slug'], null, null, false, true, null]],
        300 => [[['_route' => 'product_edit', '_controller' => 'App\\Controller\\ProductController::edit'], ['id'], null, null, false, false, null]],
        324 => [
            [['_route' => 'test', 'age' => '0', '_controller' => 'App\\Controller\\TestController::test'], ['age'], ['GET' => 0, 'POST' => 1], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
