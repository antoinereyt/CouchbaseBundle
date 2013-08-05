<?php

namespace Toiine\CouchbaseBundle\Repository;

use Toiine\CouchbaseBundle\Connexion\ConnexionInterface;
use JMS\Serializer\SerializerInterface;

/**
 * Class to request Couchbase bucket for a given Document type.
 */
class Repository
{
    /**
     * Classname of the Document.
     * @var string
     */
    protected $documentClass;

    /**
     * Classname of the Document.
     * @var Couchbase
     */
    protected $connexion;

    /**
     * Serializer
     * @var
     */
    protected $serializer;

    public function __construct($documentClass, ConnexionInterface $connexion, SerializerInterface $serializer)
    {
        $this->documentClass = $documentClass;
        $this->connexion = $connexion;
        $this->serializer = $serializer;
    }

    /**
     * Find one Document by it's key.
     *
     * @param string $key Key value of the Document
     *
     * @return Object|null that represent the fetched Document.
     */
    public function findOneByKey($key)
    {
        $rawResult = $this->connexion->get($key);

        if (!$rawResult) {
            return null;
        }

        return $this->serializer->deserialize($rawResult, $this->documentClass, 'json');
    }
}
