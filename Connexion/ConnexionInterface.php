<?php

namespace Toiine\Bundle\CouchbaseBundle\Connexion;

interface ConnexionInterface
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
}
