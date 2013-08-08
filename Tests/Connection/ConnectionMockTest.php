<?php

namespace Toiine\CouchbaseBundle\Tests\Connection;

class ConnectionMockTest extends \PHPUnit_Framework_TestCase
{
    /** @covers Toiine\CouchbaseBundle\Tests\Connection\ConnectionMock::__construct */
    public function testConstructorWitoutArguments()
    {
        $conn = new ConnectionMock();

        $this->assertEquals(array(), $conn->getDocuments());
    }

    /** @covers Toiine\CouchbaseBundle\Tests\Connection\ConnectionMock::__construct */
    public function testConstructorWitoutDocuments()
    {
        $documents = array(
            'key1' => array('value1'),
            'key2' => array('value2')
        );

        $conn = new ConnectionMock($documents);
        $this->assertEquals($documents, $conn->getDocuments());
    }

    /** @covers Toiine\CouchbaseBundle\Tests\Connection\ConnectionMock::setDocuments */
    public function testSetDocuments()
    {
        $documents = array(
            'key1' => array('value1'),
            'key2' => array('value2')
        );

        $conn = new ConnectionMock();
        $conn->setDocuments($documents);
        $this->assertEquals($documents, $conn->getDocuments());
    }

    /** @covers Toiine\CouchbaseBundle\Tests\Connection\ConnectionMock::set */
    public function testSet()
    {
        $documents = array(
            'key3' => array('value3'),
        );

        $conn = new ConnectionMock();
        $conn->set('key3', array('value3'));
        $this->assertEquals($documents, $conn->getDocuments());
    }

    /** @covers Toiine\CouchbaseBundle\Tests\Connection\ConnectionMock::get */
    public function testGet()
    {
        $documents = array(
            'key3' => array('value3'),
        );

        $conn = new ConnectionMock($documents);
        $this->assertEquals(array('value3'), $conn->get('key3'));
    }

    /** @covers Toiine\CouchbaseBundle\Tests\Connection\ConnectionMock::get */
    public function testGetWithUnsetedKey()
    {
        $documents = array(
            'key3' => array('value3'),
        );

        $conn = new ConnectionMock($documents);
        $this->assertNull($conn->get('wrongKey'));
    }

    /** @covers Toiine\CouchbaseBundle\Tests\Connection\ConnectionMock::delete */
    public function testDelete()
    {
        $documents = array(
            'key3' => array('value3'),
        );

        $conn = new ConnectionMock($documents);
        $conn->delete('key3');

        $this->assertNull($conn->get('key3'));
    }
}
