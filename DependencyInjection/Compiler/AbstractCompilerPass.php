<?php

namespace Toiine\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class AbstractCompilerPass implements CompilerPassInterface
{
    /**
     * Get the key name of the needed configuration.
     *
     * @return string
     */
    protected function getParameterKey()
    {
        return 'toiine_couchbase.connections';
    }

    /**
     * Get the service id.
     *
     * @param  string $name
     * @return string
     */
    abstract public function getServiceId($name);

    /**
     * Get a Definition service from a configuration node.
     *
     * @param string $name
     * @param array  $params
     *
     * @return Definition
     */
    abstract public function getDefinition($name, array $params);

    /**
     * Get the DocumentManager services definitions from the configuration.
     *
     * @param array $configurations
     *
     * @return array of Definiton
     */
    public function getDefinitions($configurations)
    {
        $definitions = array();

        foreach ($configurations as $name => $params) {
            $id = $this->getServiceId($name);

            $definition = $this->getDefinition($name, $params);

            // Append definitions array
            $definitions[$id] = $definition;
        }

        return $definitions;
    }

    /**
     * @inheritDoc()
     *
     * @codeCoverageIgnore
     */
    public function process(ContainerBuilder $container)
    {
        $parameterKey = $this->getParameterKey();

        if (!$container->hasParameter($parameterKey)) {
            return;
        }

        $configurations = $container->getParameterBag()->resolveValue($container->getParameter($parameterKey));

        // DocumentManagers services
        $definitions = $this->getDefinitions($configurations);
        $container->addDefinitions($definitions);
    }

    /**
     * Generate the couchbase service id for a given connectionName
     *
     * @param string $connectionName : the connection name
     *
     * @return string : the service id
     */
    public function generateCouchbaseServiceId($connectionName)
    {
        return sprintf('couchbase.%s', $connectionName);
    }

    /**
     * Generate the connection service id for a given connectionName
     *
     * @param string $connectionName : the connection name
     *
     * @return string : the service id
     */
    public function generateConnectionServiceId($connectionName)
    {
        return sprintf('couchbase.connection.%s', $connectionName);
    }

    /**
     * Generate the documentManager service id for a given connectionName
     *
     * @param string $connectionName : the connection name
     *
     * @return string : the service id
     */
    public function generateDocumentManagerServiceId($connectionName)
    {
        return sprintf('couchbase.document_manager.%s', $connectionName);
    }

    /**
     * Generate the repository service id for a given repositoryName
     *
     * @param string $connectionName : the connection name
     *
     * @return string : the service id
     */
    public function generateRepositoryServiceId($repositoryName)
    {
        return sprintf('couchbase.repository.%s', $repositoryName);
    }
}
