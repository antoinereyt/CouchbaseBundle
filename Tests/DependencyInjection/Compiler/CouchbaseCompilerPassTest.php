<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\CouchbaseCompilerPass;

class CouchbaseCompilerPassTest extends CompilerPassTestCase
{
    public function testProcessHasBuiltAllServices()
    {
        $container = new ContainerBuilder();
        $container->setParameter('toiine_couchbase.connections',  $this->getConnectionsParameters());

        $this->process($container);

        // Couchbase services
        $this->assertTrue($container->hasDefinition('couchbase.conn1'));
        $this->assertEquals('Couchbase', $container->getDefinition('couchbase.conn1')->getClass());
        $this->assertEquals(array(
                'localhost:8091',
                'user',
                'passw0rd',
                'bucket1',
            )
        , $container->getDefinition('couchbase.conn1')->getArguments());

        $this->assertTrue($container->hasDefinition('couchbase.conn2'));
                $this->assertEquals(array(
                '10.0.0.1:9191',
                'user2',
                'passw0rd2',
                'bucket2',
            )
        , $container->getDefinition('couchbase.conn2')->getArguments());
    }

    protected function process(ContainerBuilder $container)
    {
        parent::process($container);

        $pass = new CouchbaseCompilerPass();
        $pass->process($container);
    }
}
