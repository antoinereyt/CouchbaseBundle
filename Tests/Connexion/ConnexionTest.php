<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\Connexion;

require_once 'Phake.php';
use \Phake;

use Toiine\Bundle\CouchbaseBundle\Connexion\Connexion;

class ConnexionTest extends \PHPUnit_Framework_TestCase
{
    /** @covers Toiine\Bundle\CouchbaseBundle\Connexion\Connexion::__construct */
    public function setUp()
    {
        $this->couchbase = Phake::mock('Couchbase');
        Phake::when($this->couchbase)->get('key')->thenReturn(array('value'));
        $this->connexion = new Connexion($this->couchbase);
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\Connexion\Connexion::get */
    public function testSet()
    {
        $this->connexion->get('key');

        Phake::verify($this->couchbase)->get('key');
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\Connexion\Connexion::set */
    public function testGet()
    {
        $this->connexion->set('key', array('value'));

        Phake::verify($this->couchbase)->set('key', array('value'));
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\Connexion\Connexion::delete */
    public function testDelete()
    {
        $this->connexion->delete('key');

        Phake::verify($this->couchbase)->delete('key');
    }
}
