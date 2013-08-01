<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\Connexion;

use Toiine\Bundle\CouchbaseBundle\Connexion\Connexion;

class ConnexionTest extends \PHPUnit_Framework_TestCase
{
    /** @covers Toiine\Bundle\CouchbaseBundle\Connexion\Connexion::__construct */
    public function setUp()
    {
        $this->couchbase = $this->getMockBuilder('nonexistant')
            ->setMockClassName('Couchbase')
            ->setMethods(array('get', 'set', 'delete'))
            ->getMock();

        $connexion = new Connexion($this->couchbase);
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\Connexion\Connexion::get */
    public function testSet()
    {
        $connexion = new Connexion($this->couchbase);

        $this->couchbase
            ->expects($this->once())
            ->method('get')
        ;

        $connexion->get('');
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\Connexion\Connexion::set */
    public function testGet()
    {
        $connexion = new Connexion($this->couchbase);

        $this->couchbase
            ->expects($this->once())
            ->method('set')
        ;

        $connexion->set('key', array('value'));
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\Connexion\Connexion::delete */
    public function testDelete()
    {
        $connexion = new Connexion($this->couchbase);

        $this->couchbase
            ->expects($this->once())
            ->method('delete')
        ;

        $connexion->delete('key');
    }
}
