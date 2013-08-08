<?php

namespace Toiine\CouchbaseBundle\Connection;

interface ConnectionInterface
{
    /**
     * Get a Document by it's key.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * Push a Document to Couchbase.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value);

    /**
     * Delete a Document from Couchbase.
     *
     * @param string $key
     */
    public function delete($key);

    /**
     * Return the documents from a couchbase view.
     *
     * @see Couchbase::view
     */
    public function view($document, $view = "", $options = array(), $return_errors = false);
}
