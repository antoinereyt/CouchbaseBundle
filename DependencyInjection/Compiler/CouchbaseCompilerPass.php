<?php

namespace Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Create dynamically the couchbase.<connectionName> services using the configuration.
 */
class CouchbaseCompilerPass extends CompilerPass implements CompilerPassInterface
{
    /**
     * Get the connections services definitions from the configuration.
     *
     * @param  array $connectionsConfigurations : all the connections parameters
     *
     * @return array of Definiton
     */
    public function getDefinitions($configurations)
    {
        $definitions = array();

        foreach ($configurations as $name => $params) {
            // Build serviceId
            $id = $this->generateCouchbaseServiceId($name);

            // Build arguments
            $args = array(
                sprintf('%s:%s', $params['host'], $params['port']),
                $params['username'],
                $params['password'],
                $params['bucket'],
            );

            // Build definition
            $definition = new Definition('Couchbase', $args);

            // Append definitions array
            $definitions[$id] = $definition;
        }

        return $definitions;
    }
}
