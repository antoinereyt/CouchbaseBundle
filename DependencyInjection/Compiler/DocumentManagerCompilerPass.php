<?php

namespace Toiine\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Create dynamically the couchbase.document_manager.<connectionName> services using the configuration.
 */
class DocumentManagerCompilerPass extends AbstractCompilerPass implements CompilerPassInterface
{
    /** @{@inheritdoc} */
    public function getServiceId($name)
    {
        return $this->generateDocumentManagerServiceId($name);
    }

    /** @{@inheritdoc} */
    public function getDefinition($name, array $params)
    {
        // Build arguments
        $args = array(
            new Reference($this->generateConnectionServiceId($name)),
        );

        // Build definition
        $definition = new Definition('Toiine\CouchbaseBundle\Manager\DocumentManager', $args);

        return $definition;
    }
}
