<?php

namespace Toiine\Bundle\CouchbaseBundle\Manager;

use Toiine\Bundle\CouchbaseBundle\Entity\Document;
use Toiine\Bundle\CouchbaseBundle\Connexion\ConnexionInterface;

/**
 * Get/Set/Delete Document objects through a connection to a Couchbase bucket.
 */
class DocumentManager
{
    /**
     * Connection to a couchbase bucket
     * @var Couchbase
     */
    protected $connection;

    /**
     * Constructor.
     *
     * @param Couchbase $connection
     */
    public function __construct(ConnexionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get a Document by it's key.
     *
     * @param string $key
     *
     * @return Document
     */
    public function get($key)
    {
        $rawDocument = $this->connection->get($key);

        if (!$rawDocument) {
            return null;
        }

        return new Document($key, $rawDocument);
    }

    /**
     * Push a Document to Couchbase.
     *
     * @param Document $document
     */
    public function set(Document $document)
    {
        $this->connection->set($document->getKey(), $document->getValue());
    }

    /**
     * Delete a Document from Couchbase.
     *
     * @param Document $document
     */
    public function delete(Document $document)
    {
        $this->connection->delete($document->getKey());
    }
}
