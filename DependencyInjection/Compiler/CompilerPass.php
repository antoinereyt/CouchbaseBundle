<?php

namespace Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc()
     *
     * @codeCoverageIgnore
     */
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
     * Generate the couchbase service id for a given connectionName
     *
     * @param  string $connectionName : the connection name
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
     * @param  string $connectionName : the connection name
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
     * @param  string $connectionName : the connection name
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
     * @param  string $connectionName : the connection name
     *
     * @return string : the service id
     */
    public function generateRepositoryServiceId($repositoryName)
    {
        return sprintf('couchbase.repository.%s', $repositoryName);
    }
}
