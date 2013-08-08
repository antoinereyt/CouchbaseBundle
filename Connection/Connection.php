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

    /**
     * Return the documents from a Couchbase view.
     *
     * @see Couchbase::view
     */
    public function view($document, $view = "", $options = array(), $return_errors = false)
    {
        return $this->couchbase->view($document, $view, $options, $return_errors);
    }
}
