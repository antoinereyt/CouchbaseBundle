<?php

namespace Toiine\CouchbaseBundle\Serializer;

use Toiine\CouchbaseBundle\Entity\DocumentInterface;

/**
 * Interface for a json serializer.
 */
interface SerializerInterface
{
    /**
     * Serialize a DocumentInterface object in json format
     *
     * @param  DocumentInterface $object
     *
     * @return string
     */
    public function serialize(DocumentInterface $object);

    /**
     * Serialize a json string in a DocumentInterface object
     *
     * @param  string $json
     *
     * @return DocumentInterface
     */
    public function deserialize($json);
}