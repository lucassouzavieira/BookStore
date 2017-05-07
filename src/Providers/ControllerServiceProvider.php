<?php

namespace App\Providers;

use App\Controllers\HomeController;
use App\Controllers\BookController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ControllerServiceProvider implements ServiceProviderInterface
{
    /**
     * Register your controllers here
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['home'] = function (Container $app) {
            return new HomeController($app);
        };

        $app['book'] = function (Container $app) {
            return new BookController($app);
        };
    }
}
