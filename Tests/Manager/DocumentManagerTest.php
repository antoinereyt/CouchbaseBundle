<?php

namespace Toiine\CouchbaseBundle\Tests\Manager;

use Toiine\CouchbaseBundle\Manager\DocumentManager;
use Toiine\CouchbaseBundle\Tests\Connection\ConnectionMock;
use Toiine\CouchbaseBundle\Entity\Document;

class DocumentManagerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->documents = array('key1' =>
            '{
                "k": "val"
            }'
        );

        $connection = new ConnectionMock($this->documents);
        $this->manager = new DocumentManager($connection);
    }

    /** covers Toiine\CouchbaseBundle\Manager\DocumentManager::get */
    public function testGet()
    {
        $document = $this->manager->get('key1');

        $this->assertInstanceOf('Toiine\CouchbaseBundle\Entity\Document', $document);
        $this->assertNull($this->manager->get('wrongKey'));
    }

    /** covers Toiine\CouchbaseBundle\Manager\DocumentManager::set */
    public function testSet()
    {
        $doc = new Document('key3', array('value3'));
        $this->manager->set($doc);

        $this->assertEquals($doc, $this->manager->get('key3'));
    }

    /** covers Toiine\CouchbaseBundle\Manager\DocumentManager::set */
    public function testDelete()
    {
        $doc = new Document('key1', array('value1'));
        $this->manager->delete($doc);

        $this->assertNull($this->manager->get('key1'));
    }
}
