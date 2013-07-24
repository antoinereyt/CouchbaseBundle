<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\DependencyInjection;

use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getTestConfigTreeData
     */
    public function testConfigTree($options, $results)
    {
        $processor = new Processor();
        $configuration = new Configuration(array());
        $config = $processor->processConfiguration($configuration, array($options));

        $this->assertEquals($results, $config);
    }

    public function getTestConfigTreeData()
    {
        return array(
            array(
                // No specify host & port.
                array(
                    'connections' => array(
                        'conn1' => array(
                            'username' => 'user',
                            'password' => 'passw0rd',
                            'bucket'   => 'bucket1'
                        )
                    )
                ),
                array(
                    'connections' => array(
                        'conn1' => array(
                            'host'     => 'localhost',
                            'port'     => '8091',
                            'username' => 'user',
                            'password' => 'passw0rd',
                            'bucket'   => 'bucket1'
                        )
                    )
                ),
                // Specify everything
                array(
                    'connections' => array(
                        'conn1' => array(
                            'host'     => '10.0.0.4',
                            'port'     => '9191',
                            'username' => 'user',
                            'password' => 'passw0rd',
                            'bucket'   => 'bucket1'
                        )
                    )
                ),
                array(
                    'connections' => array(
                        'conn1' => array(
                            'host'     => '10.0.0.4',
                            'port'     => '9191',
                            'username' => 'user',
                            'password' => 'passw0rd',
                            'bucket'   => 'bucket1'
                        )
                    )
                )
            )
        );
    }
}
