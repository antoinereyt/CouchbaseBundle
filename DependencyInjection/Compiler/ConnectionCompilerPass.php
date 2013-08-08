<?php

namespace Toiine\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Create dynamically the couchbase.connection.<connectionName> services using the configuration.
 */
class ConnectionCompilerPass extends AbstractCompilerPass implements CompilerPassInterface
{
    /** @{@inheritdoc} */
    public function getServiceId($name)
    {
        return $this->generateConnectionServiceId($name);
    }

    /** @{@inheritdoc} */
    public function getDefinition($name, array $params)
    {
        // Build arguments
        $args = array(
            new Reference($this->generateCouchbaseServiceId($name))
        );

        // Build definition
        $definition = new Definition('Toiine\CouchbaseBundle\Connection\Connection', $args);

        return $definition;
    }
}
