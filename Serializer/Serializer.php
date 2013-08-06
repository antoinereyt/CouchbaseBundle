<?php

namespace Toiine\CouchbaseBundle\Serializer;

use JMS\Serializer\SerializerInterface as JMSSerializerInterface;
use Toiine\CouchbaseBundle\Entity\DocumentInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\DeserializationContext;

/**
 * Json serializer.
 */
class Serializer implements SerializerInterface
{
    /**
     * JMS Serializer instance
     * @var JMS\Serializer\SerializerInterface
     */
    protected $jmsSerializer;

    /**
     * Classname of the Document.
     * @var string
     */
    protected $documentClass;

    /**
     * JMSSerializer Groups exclustion strategy parameter.
     * Allow to have different serialization profiles (view) of the same entity.
     *
     * @var string
     * @see http://jmsyst.com/libs/serializer/master/reference/annotations#groups
     */
    protected $groupName;

    /**
     * Classname of the Document.
     *
     * @param JMSSerializerInterface $jmsSerializer
     * @param string                 $documentClass
     * @param string|null            $groupName
     */
    public function __construct(JMSSerializerInterface $jmsSerializer, $documentClass, $groupName = null)
    {
        $this->jmsSerializer = $jmsSerializer;
        $this->documentClass = $documentClass;
        $this->groupName     = $groupName;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize(DocumentInterface $object)
    {
        $context = SerializationContext::create();
        if (!is_null($this->groupName)) {
            $context->setGroups(array($this->groupName));
        }

        return $this->jmsSerializer->serialize($object, 'json', $context);
    }

    /**
     * {@inheritdoc}
     */
    public function deserialize($json)
    {
        $context = DeserializationContext::create();
        if (!is_null($this->groupName)) {
            $context->setGroups(array($this->groupName));
        }

        return $this->jmsSerializer->deserialize($json, $this->documentClass, 'json', $context);
    }
}