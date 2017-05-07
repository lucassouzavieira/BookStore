<?php

namespace App\Providers\Arango;

use Silex\Application;

/**
 * Class Collection
 * @package App\Providers\Arango
 */
class Collection
{
    public $collection;

    public $validationRules;

    protected $connection;

    public function __construct(Application $app)
    {
        $this->connection = $app['arango'];
    }
}
