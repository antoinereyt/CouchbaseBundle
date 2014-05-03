<?php

namespace Toiine\CouchbaseBundle\Connection;

use Couchbase;

/**
 * Wrapper of Couchbase.
 */
class Connection implements ConnectionInterface
{
    /**
     * Connection to a Couchbase bucket
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
     * @param string $key
     *
     * @return mixed
     *
     * @see Couchbase::get
     */
    public function get($key)
    {
        return $this->couchbase->get($key);
    }

    /**
     * Push a document to Couchbase.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @see Couchbase::set
     */
    public function set($key, $value)
    {
        $this->couchbase->set($key, $value);
    }

    /**
     * Delete a document from Couchbase.
     *
     * @param string $key
     *
     * @see Couchbase::delete
     */
    public function delete($key)
    {
        $this->couchbase->delete($key);
    }

    /**
     * Return the documents from a Couchbase view.
     *
     * @see Couchbase::view
     */
    public function view($document, $view = '', $options = array(), $returnErrors = false)
    {
        return $this->couchbase->view($document, $view, $options, $returnErrors);
    }
}
