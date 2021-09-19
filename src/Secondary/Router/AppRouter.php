<?php

namespace LinkReducer\Secondary\Router;

use Bramus\Router\Router;
use Jasny\Auth\Auth;
use LinkReducer\Secondary\Controllers\GateController;
use LinkReducer\Secondary\Controllers\LinkReducerController;
use ProductSystem\Secondary\Controllers\AdminController;
use ProductSystem\Secondary\Controllers\GuestController;
use ProductSystem\Secondary\Controllers\ManagerController;

class AppRouter {
    public static function run(): void
    {
        $router = new Router();

        $router->post('/reducer/api/reduce', [LinkReducerController::class, 'getShortLink']);
        $router->get('/.{1,6}', function () {
            (new GateController())->handleShortLink();
        });

        $router->set404('/(.*)?', function() {
            echo '<h1>404</h1>';
        });

        $router->run();
    }

    private function __construct() { }
    private function __clone() { }
    public function __wakeup() {}
}


