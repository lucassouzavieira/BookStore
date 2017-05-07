<?php

namespace App\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use App\Helpers\RouteConfiguration;


class RouterServiceProvider implements ServiceProviderInterface
{
    private $routes;


    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Register all aplication routes
     * @param Container $app
     */
    public function register(Container $app)
    {
        $routes = $this->routes;
        $prefix = $app['config']['api']['prefix'] . '/';
        $version = $app['config']['api']['version'];

        foreach ($routes as $routeName => $params){
            $method = (string) $params['method'];
            $method = mb_strtolower($method);
            $app->$method( $prefix . $version  . $routeName, $params['to']);
        }
    }
}
