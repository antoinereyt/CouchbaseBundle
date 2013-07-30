<?php

namespace Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Create dynamically the couchbase.connection.<connectionName> services using the configuration.
 */
class CouchbaseConnectionCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('toiine_couchbase.connections')) {
            return;
        }

        $connectionsConfigurations = $container->getParameterBag()->resolveValue($container->getParameter('toiine_couchbase.connections'));

        // Connections services
        $connectionServicesDefinitions = $this->getConnectionsDefinitions($connectionsConfigurations);
        $container->addDefinitions($connectionServicesDefinitions);

        // DocumentManagers services
        $docManagerDefinitions = $this->getManagersDefinitions($connectionsConfigurations);
        $container->addDefinitions($docManagerDefinitions);

        if (!$container->hasParameter('toiine_couchbase.repositories')) {
            return;
        }
        $repositoriesConfigurations = $container->getParameterBag()->resolveValue($container->getParameter('toiine_couchbase.repositories'));

        // Repository services
        $repositoriesDefinitions = $this->getRepositoriesDefinitions($repositoriesConfigurations);
        $container->addDefinitions($repositoriesDefinitions);

    }

    /**
     * Get the connections services definitions from the configuration.
     *
     * @param  array $connectionsConfigurations : all the connections parameters
     *
     * @return array of Definiton
     */
    public function getConnectionsDefinitions($connectionsConfigurations)
    {
        $definitions = array();

        foreach ($connectionsConfigurations as $name => $params) {
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

    /**
     * Get the DocumentManager services definitions from the configuration.
     *
     * @param  array $connectionsConfigurations : all the connections parameters
     *
     * @return array of Definiton
     */
    public function getManagersDefinitions($connectionsConfigurations)
    {
        $definitions = array();

        foreach ($connectionsConfigurations as $name => $params) {
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

    /**
     * Get the DocumentManager services definitions from the configuration.
     *
     * @param  array $connectionsConfigurations : all the connections parameters
     *
     * @return array of Definiton
     */
    public function getRepositoriesDefinitions($repositoriesConfigurations)
    {
        $definitions = array();

        foreach ($repositoriesConfigurations as $name => $params) {
            $id = sprintf('couchbase.repository.%s', $name);

            $serializerServiceId = isset($params['serializer'])? $params['serializer'] : null;
            $repositoryClass = isset($params['repositoryClass'])? $params['repositoryClass'] : 'Toiine\Bundle\CouchbaseBundle\Respository\Respository';

            $args = array(
                $params['documentClass'],
                new Reference(sprintf('couchbase.connection.%s', $params['connection'])),
                $serializerServiceId? new Reference($serializerServiceId):null
            );

            // Build definition
            $definition = new Definition($repositoryClass, $args);

            // Append definitions array
            $definitions[$id] = $definition;
        }

        return $definitions;
    }
}
