<?php

namespace Toiine\CouchbaseBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Toiine\CouchbaseBundle\DependencyInjection\Compiler\DocumentManagerCompilerPass;

class DocumentManagerCompilerPassTest extends CompilerPassTestCase
{
    public function testProcessHasBuiltAllServices()
    {
        $container = new ContainerBuilder();
        $container->setParameter('toiine_couchbase.connections',  $this->getConnectionsParameters());

        $this->process($container);

        // DocumentManager services
        $this->assertTrue($container->hasDefinition('toiine_couchbase.document_manager.conn1'));
        $this->assertTrue($container->hasDefinition('toiine_couchbase.document_manager.conn2'));
    }

    protected function process(ContainerBuilder $container)
    {
        parent::process($container);

        $pass = new DocumentManagerCompilerPass();
        $pass->process($container);
    }
}
