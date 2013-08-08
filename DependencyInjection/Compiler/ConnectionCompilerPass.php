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

    /** @{@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function getDefinition($name, array $params)
    {
        // Build arguments
        $reference = new Reference($this->generateCouchbaseServiceId($name));
        $args = array(
            $reference
        );

        // Build definition
        $definition = new Definition('Toiine\CouchbaseBundle\Connection\Connection', $args);

        return $definition;
    }
}
