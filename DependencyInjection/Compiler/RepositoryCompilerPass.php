<?php

namespace Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Create dynamically the couchbase.repository.<connectionName> services using the configuration.
 */
class RepositoryCompilerPass extends CompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('toiine_couchbase.repositories')) {
            return;
        }

        $configurations = $container->getParameterBag()->resolveValue($container->getParameter('toiine_couchbase.repositories'));

        // Repository services
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
            $id = $this->generateRepositoryServiceId($name);

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
