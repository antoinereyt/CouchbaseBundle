<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Symfony\Component\DependencyInjection\Compiler\CheckDefinitionValidityPass;

use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\CouchbaseConnectionCompilerPass;

class CouchbaseConnectionCompilerPassTest extends \PHPUnit_Framework_TestCase
{
    public function testProcessHasBuiltAllCouchbaseConnectionServices()
    {
        $container = new ContainerBuilder();
        $container->setParameter('toiine_couchbase.connections', $this->getParameters());

        $this->process($container);

        $this->assertTrue($container->hasDefinition('couchbase.connection.conn1'));
        $this->assertTrue($container->hasDefinition('couchbase.connection.conn2'));
    }

    protected function process(ContainerBuilder $container)
    {
        $pass = new CouchbaseConnectionCompilerPass();
        $pass->process($container);
    }

    protected function getParameters()
    {
        return array(
            'conn1' => array(
                'host'     => 'localhost',
                'port'     => '8091',
                'username' => 'user',
                'password' => 'passw0rd',
                'bucket'   => 'bucket1'
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