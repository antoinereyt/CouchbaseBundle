<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\ConnectionCompilerPass;

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
    }

    protected function process(ContainerBuilder $container)
    {
        parent::process($container);

        $pass = new ConnectionCompilerPass();
        $pass->process($container);
    }
}
