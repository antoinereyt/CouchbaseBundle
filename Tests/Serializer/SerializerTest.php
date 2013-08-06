<?php

namespace Toiine\CouchbaseBundle\Tests\Serializer;

use Toiine\CouchbaseBundle\Tests\Serializer\Fixture\FakeBookDocument;
use Toiine\CouchbaseBundle\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

/**
 * @group functional
 */
class SerializerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $jmsSerializer = SerializerBuilder::create()
            ->addMetadataDir(dirname(__FILE__).'/Fixture/')
            ->build()
        ;

        $this->object = $this->getObject();
        $this->json['short']   = $this->getJson('short');
        $this->json['details'] = $this->getJson('details');

        $this->serializer['short']   = new Serializer($jmsSerializer, 'Toiine\CouchbaseBundle\Tests\Serializer\Fixture\FakeBookDocument', 'short');
        $this->serializer['details'] = new Serializer($jmsSerializer, 'Toiine\CouchbaseBundle\Tests\Serializer\Fixture\FakeBookDocument', 'details');
    }

    public function testSerialize()
    {
        $this->assertEquals(
            $this->json['short'],
            $this->serializer['short']->serialize($this->object)
        );

        $this->assertEquals(
            $this->json['details'],
            $this->serializer['details']->serialize($this->object)
        );
    }

    public function testDeserialize()
    {
        $this->assertEquals(
            $this->object,
            $this->serializer['details']->deserialize($this->json['details'])
        );
    }

    protected function getObject()
    {
        $object = new FakeBookDocument();
        $object->title      = 'book_title';
        $object->author     = 'book_author';
        $object->isbn       = 'book_isbn';
        $object->dimensions = 'book_dimensions';
        $object->weigth     = 'book_weigth';

        return $object;
    }

    protected function getJson($mode)
    {
        switch ($mode) {
            case 'short':
                $json = '
                    {
                        "title":      "book_title",
                        "author":     "book_author",
                        "isbn":       "book_isbn"
                    }'
                ;
                break;
            case 'details':
                $json = '
                    {
                        "title":      "book_title",
                        "author":     "book_author",
                        "isbn":       "book_isbn",
                        "dimensions": "book_dimensions",
                        "weigth":     "book_weigth"
                    }'
                ;
                break;
        }

        return preg_replace('/[\s]/mi', '', $json);
    }
}
