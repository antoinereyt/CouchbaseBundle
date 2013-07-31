<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\Manager;

use Toiine\Bundle\CouchbaseBundle\Manager\DocumentManager;
use Toiine\Bundle\CouchbaseBundle\Tests\Connexion\ConnexionMock;
use Toiine\Bundle\CouchbaseBundle\Entity\Document;

class DocumentManagerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->documents = array('key1' => array('document1'));

        $connexion = new ConnexionMock($this->documents);
        $this->manager = new DocumentManager($connexion);
    }

    /** covers Toiine\Bundle\CouchbaseBundle\Manager\DocumentManager::get */
    public function testGet()
    {
        $document = $this->manager->get('key1');

        $this->assertInstanceOf('Toiine\Bundle\CouchbaseBundle\Entity\Document', $document);
        $this->assertNull($this->manager->get('wrongKey'));
    }

    /** covers Toiine\Bundle\CouchbaseBundle\Manager\DocumentManager::set */
    public function testSet()
    {
        $doc = new Document('key3', array('value3'));
        $this->manager->set($doc);

        $this->assertEquals($doc, $this->manager->get('key3'));
    }

    /** covers Toiine\Bundle\CouchbaseBundle\Manager\DocumentManager::set */
    public function testDelete()
    {
        $doc = new Document('key1', array('value1'));
        $this->manager->delete($doc);

        $this->assertNull($this->manager->get('key1'));
    }
}