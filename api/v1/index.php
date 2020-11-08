<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bootstrap/autoload.php';

use \FastRoute\RouteCollector as RouteCollector;
use \App\Router\User;

$dispatcher = \FastRoute\simpleDispatcher(
    function (RouteCollector $r) {
        $r->addGroup(
            '/api/v1',
            function (RouteCollector $r) {
                $r->addGroup(
                    '/user',
                    function (RouteCollector $r) {
                        User::route($r);
                    }
                );
            }
        );
    }
);

require_once('dispatch.php');
