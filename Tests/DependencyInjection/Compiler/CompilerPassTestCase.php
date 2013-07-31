<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

class CompilerPassTestCase extends \PHPUnit_Framework_TestCase
{
    public function testProcessWithEmptyconfig()
    {
        $container = new ContainerBuilder();

        $this->process($container);
    }

    protected function process(ContainerBuilder $container)
    {
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