<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\RepositoryCompilerPass;

class RepositoryCompilerPassTest extends \PHPUnit_Framework_TestCase
{
    public function testProcessWithEmptyconfig()
    {
        $container = new ContainerBuilder();

        $this->process($container);
    }

    public function testProcessHasBuiltAllCouchbaseConnectionServices()
    {
        $container = new ContainerBuilder();
        $container->setParameter('toiine_couchbase.connections',  $this->getConnectionsParameters());
        $container->setParameter('toiine_couchbase.repositories', $this->getRepositoriesParameters());

        $this->process($container);

        // Repository services
        $this->assertTrue($container->hasDefinition('couchbase.repository.foo'));
        $this->assertEquals('Toiine\Bundle\CouchbaseBundle\Respository\Respository', $container->getDefinition('couchbase.repository.foo')->getClass());

        $this->assertTrue($container->hasDefinition('couchbase.repository.bar'));
        $this->assertEquals('Vendor\\Bundle\\BarBundle\\epository\\BarRepository', $container->getDefinition('couchbase.repository.bar')->getClass());
    }

    protected function process(ContainerBuilder $container)
    {
        $pass = new RepositoryCompilerPass();
        $pass->process($container);
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
                'host'     => '10.0.0.1',
                'port'     => '9191',
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
