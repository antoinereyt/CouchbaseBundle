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
     * JMSSerializer option of context to serialize null values.
     *
     * @var boolean
     */
    protected $serializeNull;

    /**
     * Classname of the Document.
     *
     * @param JMSSerializerInterface $jmsSerializer
     * @param string                 $documentClass
     * @param string|null            $groupName
     * @param boolean                $serializeNull
     */
    public function __construct(JMSSerializerInterface $jmsSerializer, $documentClass, $groupName = null, $serializeNull = true)
    {
        $this->jmsSerializer = $jmsSerializer;
        $this->documentClass = $documentClass;
        $this->groupName     = $groupName;
        $this->serializeNull = $serializeNull;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize(DocumentInterface $object)
    {
        $context = SerializationContext::create();
        if (!is_null($this->groupName)) {
            $context->setGroups(array($this->groupName));
            $context->setSerializeNull($this->serializeNull);
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
            $context->setSerializeNull($this->serializeNull);
        }

        return $this->jmsSerializer->deserialize($json, $this->documentClass, 'json', $context);
    }
}