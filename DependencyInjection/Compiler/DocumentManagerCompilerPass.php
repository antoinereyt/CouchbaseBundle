<?php

namespace Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Create dynamically the couchbase.dpcument_manager.<connectionName> services using the configuration.
 */
class DocumentManagerCompilerPass extends CompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('toiine_couchbase.connections')) {
            return;
        }

        $configurations = $container->getParameterBag()->resolveValue($container->getParameter('toiine_couchbase.connections'));

        // DocumentManagers services
        $definitions = $this->getDefinitions($configurations);
        $container->addDefinitions($definitions);
    }

    /**
     * Get the DocumentManager services definitions from the configuration.
     *
     * @param  array $connectionsConfigurations : all the connections parameters
     *
     * @return array of Definiton
     */
    public function getDefinitions($configurations)
    {
        $definitions = array();

        foreach ($configurations as $name => $params) {
            $id = sprintf('couchbase.document_manager.%s', $name);

            $args = array(
                new Reference(sprintf('couchbase.connection.%s', $name)),
            );

            // Build definition
            $definition = new Definition('Toiine\Bundle\CouchbaseBundle\Manager\DocumentManager', $args);

            // Append definitions array
            $definitions[$id] = $definition;
        }

        return $definitions;
    }
}
