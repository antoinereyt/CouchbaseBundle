<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\Connexion;

use Toiine\Bundle\CouchbaseBundle\Connexion\ConnexionInterface;

/**
 * Mock a Couchbase Connexion for tests.
 */
class ConnexionMock implements ConnexionInterface
{
    /**
     * Represent all the documents of a bucket.
     * @var array
     */
    protected $documents;

    public function __construct(array $document = null)
    {
        $this->documents = $document?: array();
    }

    public function get($key)
    {
        return $this->documents[$key];
    }

    public function set($key, $value)
    {
        return $this->documents[$key] = $value;
    }

    public function delete($key)
    {
        unset($this->documents[$key]);
    }

    public function setDocuments($documents)
    {
        $this->documents = $documents;
    }

    public function getDocuments()
    {
        return $this->documents;
    }
}
