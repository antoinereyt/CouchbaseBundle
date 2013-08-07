<?php

namespace Toiine\CouchbaseBundle\Repository;

use Toiine\CouchbaseBundle\Manager\DocumentManager;
use Toiine\CouchbaseBundle\Serializer\SerializerInterface;
use Toiine\CouchbaseBundle\Entity\Document;
use Toiine\CouchbaseBundle\Entity\DocumentInterface;

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
     * SerializerInterface
     * @var
     */
    protected $serializer;

    public function __construct($documentClass, DocumentManager $documentManager, SerializerInterface $serializer)
    {
        $this->documentClass = $documentClass;
        $this->documentManager = $documentManager;
        $this->serializer = $serializer;
    }

    /**
     * Find one Document by it's key.
     *
     * @param string $key Key value of the Document
     *
     * @return DocumentInterface|null that represent the fetched Document.
     */
    public function findOneByKey($key)
    {
        $document = $this->documentManager->get($key);

        if (!$document) {
            return null;
        }

        return $this->serializer->deserialize($document->getValue(), $this->documentClass, 'json');
    }

    public function persist(DocumentInterface $document)
    {
        $doc = $this->getDocument($document);

        $this->documentManager->set($doc);
    }

    public function getDocument(DocumentInterface $document)
    {
        if ($document instanceof Document) {
            return $document;
        }

        if ($document instanceof DocumentInterface) {
            $value = $this->serializer->serialize($document, 'json');

            return new Document($document->getKey(), $value);
        }
    // @codeCoverageIgnoreStart
    }
    // @codeCoverageIgnoreEnd
}
