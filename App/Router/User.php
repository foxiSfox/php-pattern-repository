<?php

namespace App\Router;

use \App\Utils;
use \App\RouterInterface;
use \App\Model\User as UserModel;
use \App\Controller\User as UserController;
use \FastRoute\RouteCollector;

class User implements RouterInterface
{
    public static function route(RouteCollector $r)
    {
        $r->addRoute(
            'GET',
            '[/]',
            function () {
                $filter = Utils::getBodyParams();
                return (new UserController)->getList($filter);
            }
        );

        $r->addRoute(
            'POST',
            '[/]',
            function () {
                $fields = Utils::getBodyParams();
                $user = new UserModel($fields);
                return (new UserController)->create($user);
            }
        );

        $r->addGroup(
            '/{id:\d+}',
            function (RouteCollector $r) {
                $r->addRoute(
                    'GET',
                    '[/]',
                    function ($id) {
                        return (new UserController)->getById($id);
                    }
                );

                $r->addRoute(
                    'PUT',
                    '[/]',
                    function ($id) {
                        $fields = Utils::getBodyParams();
                        $user = new UserModel(array_merge(['id' => $id], $fields));
                        return (new UserController)->update($user);
                    }
                );

                $r->addRoute(
                    'DELETE',
                    '[/]',
                    function ($id) {
                        return (new UserController)->delete($id);
                    }
                );
            }
        );
    }
}
