<?php

namespace Toiine\Bundle\CouchbaseBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('toiine_couchbase');

        $rootNode
            ->children()
                ->append($this->addConnectionNode())
            ->end()
        ;
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }

    public function addConnectionNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('connections');

        $node
            ->isRequired()
            ->requiresAtLeastOneElement()
            ->useAttributeAsKey('name')
            ->prototype('array')
                ->children()
                    ->scalarNode('host')
                        ->cannotBeEmpty()
                        ->defaultValue('localhost')
                    ->end()
                    ->scalarNode('port')
                        ->cannotBeEmpty()
                        ->defaultValue('8091')
                    ->end()
                    ->scalarNode('username')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->scalarNode('password')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->scalarNode('bucket')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                ->end()
            ->end()
        ;

        return $node;
    }
}
