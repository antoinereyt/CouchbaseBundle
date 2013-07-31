<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\DocumentManagerCompilerPass;

class DocumentManagerCompilerPassTest extends \PHPUnit_Framework_TestCase
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

        $this->process($container);

        // DocumentManager services
        $this->assertTrue($container->hasDefinition('couchbase.document_manager.conn1'));
        $this->assertTrue($container->hasDefinition('couchbase.document_manager.conn2'));
    }

    protected function process(ContainerBuilder $container)
    {
        $pass = new DocumentManagerCompilerPass();
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
}
