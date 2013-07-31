<?php

namespace Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Create dynamically the couchbase.connection.<connectionName> services using the configuration.
 */
class ConnectionCompilerPass extends CompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('toiine_couchbase.connections')) {
            return;
        }

        $configurations = $container->getParameterBag()->resolveValue($container->getParameter('toiine_couchbase.connections'));

        // Connections services
        $definitions = $this->getDefinitions($configurations);
        $container->addDefinitions($definitions);
    }

    /**
     * Get the connections services definitions from the configuration.
     *
     * @param  array $connectionsConfigurations : all the connections parameters
     *
     * @return array of Definiton
     */
    public function getDefinitions($configurations)
    {
        $definitions = array();

        foreach ($configurations as $name => $params) {
            // Build arguments
            $args = array(
                sprintf('%s:%s', $params['host'], $params['port']),
                $params['username'],
                $params['password'],
                $params['bucket'],
            );

            // Build definition
            $definition = new Definition('Couchbase', $args);
            $id = sprintf('couchbase.connection.%s', $name);

            // Append definitions array
            $definitions[$id] = $definition;
        }

        return $definitions;
    }
}
