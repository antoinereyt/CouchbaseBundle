<?php

namespace Toiine\CouchbaseBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Toiine\CouchbaseBundle\DependencyInjection\Compiler\ConnectionCompilerPass;

class ConnectionCompilerPassTest extends CompilerPassTestCase
{
    public function testProcessHasBuiltAllServices()
    {
        $container = new ContainerBuilder();
        $container->setParameter('toiine_couchbase.connections',  $this->getConnectionsParameters());

        $this->process($container);

        // Connection services
        $this->assertTrue($container->hasDefinition('couchbase.connection.conn1'));
        $this->assertTrue($container->hasDefinition('couchbase.connection.conn2'));

        $firstDefinition = $container->getDefinition('couchbase.connection.conn1');
        $this->assertEquals('Toiine\CouchbaseBundle\Connection\Connection', $firstDefinition->getClass());
        $this->assertInstanceOf('Symfony\Component\DependencyInjection\Reference', $firstDefinition->getArgument(0));
        $this->assertEquals('couchbase.conn1', $firstDefinition->getArgument(0));
    }

    protected function process(ContainerBuilder $container)
    {
        parent::process($container);

        $pass = new ConnectionCompilerPass();
        $pass->process($container);
    }
}
