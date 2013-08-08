<?php

namespace Toiine\CouchbaseBundle\Tests\Connexion;

use Toiine\CouchbaseBundle\Connexion\Connexion;

require_once 'Phake.php';
use \Phake;

class ConnexionTest extends \PHPUnit_Framework_TestCase
{
    /** @covers Toiine\CouchbaseBundle\Connexion\Connexion::__construct */
    public function setUp()
    {
        $this->couchbase = Phake::mock('Couchbase');
        $this->connexion = new Connexion($this->couchbase);
    }

    /** @covers Toiine\CouchbaseBundle\Connexion\Connexion::get */
    public function testGet()
    {
        $this->connexion->get('key');

        Phake::verify($this->couchbase)->get('key');
    }

    /** @covers Toiine\CouchbaseBundle\Connexion\Connexion::set */
    public function testSet()
    {
        $this->connexion->set('key', array('value'));

        Phake::verify($this->couchbase)->set('key', array('value'));
    }

    /** @covers Toiine\CouchbaseBundle\Connexion\Connexion::delete */
    public function testDelete()
    {
        $this->connexion->delete('key');

        Phake::verify($this->couchbase)->delete('key');
    }

    /** @covers Toiine\CouchbaseBundle\Connexion\Connexion::view */
    public function testView()
    {
        $this->connexion->view('designDocument', 'viewName', array('opt1' => 'val'), true);

        Phake::verify($this->couchbase)->view('designDocument', 'viewName', array('opt1' => 'val'), true);
    }
}
