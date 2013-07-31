<?php

namespace Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Create dynamically the couchbase.repository.<connectionName> services using the configuration.
 */
class RepositoryCompilerPass extends CompilerPass implements CompilerPassInterface
{
    protected function getParameterKey()
    {
        return 'toiine_couchbase.repositories';
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
                new Reference($this->generateConnectionServiceId($params['connection'])),
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
