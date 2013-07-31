<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\RepositoryCompilerPass;

class RepositoryCompilerPassTest extends CompilerPassTestCase
{
    public function testProcessHasBuiltAllServices()
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
        parent::process($container);

        $pass = new RepositoryCompilerPass();
        $pass->process($container);
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
