<?php

namespace App\Providers\Arango;

use Silex\Application;

use triagens\ArangoDb\CollectionHandler;
use triagens\ArangoDb\Document;
use triagens\ArangoDb\DocumentHandler;
use triagens\ArangoDb\ServerException;
use triagens\ArangoDb\Collection as ArangoCollection;

/**
 * Class Collection
 * @package App\Providers\Arango
 */
abstract class Collection
{
    public $collection;

    protected $connection;
    protected $collectionHandler;
    protected $documentHandler;

    public function __construct(Application $app)
    {
        $this->connection = $app['arango'];

        $this->collectionHandler = new CollectionHandler($this->connection);
        $this->documentHandler = new DocumentHandler($this->connection);

        // Create collection if not exists
        if (!$this->collectionHandler->has($this->collection)) {
            $collection = new ArangoCollection($this->collection);
            $this->collectionHandler->create($collection);
        }
    }

    public function all()
    {
        $collection = $this->collectionHandler->get($this->collection);
        return $this->collectionHandler->all($collection->getId());
    }

    public function save(array $data)
    {
        $document = new Document();

        foreach ($data as $key => $value) {
            $document->set($key, $value);
        }

        return $this->documentHandler->save($this->collection, $document);
    }
}
