<?php

namespace Toiine\CouchbaseBundle\Tests\DependencyInjection;

use Toiine\CouchbaseBundle\ToiineCouchbaseBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ToiineCouchbaseBundleTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->bundle = new ToiineCouchbaseBundle();
        $this->container = new ContainerBuilder();
    }

    public function testBuildWithEmptyConfiguration()
    {
        $this->bundle->build($this->container);
    }

    public function testBuildWithoutRepository()
    {
        $this->container->setParameter('toiine_couchbase.connections',  $this->getConnectionsParameters());

        $this->bundle->build($this->container);
    }

    public function testBuild()
    {
        $this->container->setParameter('toiine_couchbase.connections',  $this->getConnectionsParameters());
        $this->container->setParameter('toiine_couchbase.repositories',  $this->getRepositoriesParameters());

        $this->bundle->build($this->container);
    }

    protected function getConnectionsParameters()
    {
        return array(
            'conn1' => array(
                'host'     => 'localhost',
                'port'     => '8091',
                'username' => 'user',
                'password' => 'passw0rd',
                'bucket'   => 'bucket1',
            ),
            'conn2' => array(
                'username' => 'user2',
                'password' => 'passw0rd2',
                'bucket'   => 'bucket2'
            )
        );
    }

    protected function getRepositoriesParameters()
    {
        return array(
            'foo' => array(
                'documentClass' => 'Vendor\\Bundle\\FooBundle\\Document\\Foo',
                'connection'    => 'conn1',
            ),
            'bar' => array(
                'documentClass'   => 'Vendor\\Bundle\\BarBundle\\Document\\Bar',
                'connection'      => 'conn2',
                'serializer'      => 'bar_bundle.serializer',
                'repositoryClass' => 'Vendor\\Bundle\\BarBundle\\epository\\BarRepository',
            ),
        );
    }
}
