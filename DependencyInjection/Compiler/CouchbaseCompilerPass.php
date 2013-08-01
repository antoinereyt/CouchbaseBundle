<?php

namespace Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Create dynamically the couchbase.<connectionName> services using the configuration.
 */
class CouchbaseCompilerPass extends AbstractCompilerPass implements CompilerPassInterface
{
    /** @{@inheritdoc} */
    public function getServiceId($name)
    {
        return $this->generateCouchbaseServiceId($name);
    }

    /** @{@inheritdoc} */
    public function getDefinition($name, array $params)
    {
        // Build arguments
        $args = array(
            sprintf('%s:%s', $params['host'], $params['port']),
            $params['username'],
            $params['password'],
            $params['bucket'],
        );

        // Build definition
        $definition = new Definition('Couchbase', $args);

        return $definition;
    }
}