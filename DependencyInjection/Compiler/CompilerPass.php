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
