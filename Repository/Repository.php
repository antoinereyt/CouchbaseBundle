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
     * @var DocumentManager
     */
    protected $documentManager;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    public function __construct(DocumentManager $documentManager, SerializerInterface $serializer)
    {
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

        return $this->serializer->deserialize($document->getValue());
    }

    public function persist(DocumentInterface $document)
    {
        $doc = $this->getDocument($document);

        $this->documentManager->set($doc);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function getDocument(DocumentInterface $document)
    {
        if ($document instanceof Document) {
            return $document;
        }

        if ($document instanceof DocumentInterface) {
            $value = $this->serializer->serialize($document);

            return new Document($document->getKey(), $value);
        }
    // @codeCoverageIgnoreStart
    }
    // @codeCoverageIgnoreEnd
}
