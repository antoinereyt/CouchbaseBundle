<?php

namespace Toiine\CouchbaseBundle\Connexion;

use Couchbase;

/**
 * Wrapper of Couchbase.
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
     * Get a document by it's key.
     *
     * @see Couchbase::get
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->couchbase->get($key);
    }

    /**
     * Push a document to Couchbase.
     *
     * @see Couchbase::set
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->couchbase->set($key, $value);
    }

    /**
     * Delete a document from Couchbase.
     *
     * @see Couchbase::delete
     *
     * @param string $key
     */
    public function delete($key)
    {
        $this->couchbase->delete($key);
    }
}
