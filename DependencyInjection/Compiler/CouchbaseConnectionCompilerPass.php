<?php

namespace Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class CouchbaseConnectionCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $connectionsConfigurations = $container->getParameterBag()->resolveValue($container->getParameter('toiine_couchbase.connections'));

        $connectionServicesDefinitions = $this->getDefinitions($connectionsConfigurations);
        $container->addDefinitions($connectionServicesDefinitions);
    }

    public function getDefinitions($connectionsConfigurations)
    {
        $definitions = array();

        foreach ($connectionsConfigurations as $name => $params) {
            $args = array(
                sprintf('%s:%s', $params['host'], $params['port']),
                $params['username'],
                $params['password'],
                $params['bucket'],
            );

            $definition = new Definition('Couchbase', $args);
            $id = sprintf('couchbase.connection.%s', $name);
            $definitions[$id] = $definition;
        }

        return $definitions;
    }
}
