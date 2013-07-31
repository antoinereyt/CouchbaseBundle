<?php

namespace Toiine\Bundle\CouchbaseBundle\Connexion;

use Couchbase;

/**
 * Represent a Couchbase Connexion.
 */
class Connexion implements ConnexionInterface
{
    /**
     * Connexion to a Couchbase bucket
     * @var Couchbase
     */
    protected $couchbase;

    /**
     * Constructor.
     *
     * @param Couchbase $couchbase
     */
    public function __construct(Couchbase $couchbase)
    {
        $this->couchbase = $couchbase;
    }

    /**
     * Get a Document by it's key.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->couchbase->get($key);
    }

    /**
     * Push a Document to Couchbase.
     *
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->couchbase->set($key, $value);
    }

    /**
     * Delete a Document from Couchbase.
     *
     * @param string $key
     */
    public function delete($key)
    {
        $this->couchbase->delete($key);
    }
}
