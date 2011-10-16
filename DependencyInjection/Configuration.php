<?php

namespace EWZ\Bundle\OmlexBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ewz_omlex');

        $rootNode
            ->children()
                ->arrayNode('providers')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('endpoint')->end()
                        ->arrayNode('schemes')
                            ->prototype('array')->end()
                        ->end()
                        ->scalarNode('url')->end()
                        ->scalarNode('name')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
