<?php

namespace EWZ\Bundle\OmlexBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('ewz_omlex');

        $rootNode
            ->children()
                ->arrayNode('providers')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->prototype('array')
                    ->children()
                        ->scalarNode('endpoint')->end()
                        ->arrayNode('schemes')
                            ->useAttributeAsKey('scheme')
                            ->prototype('array')
                            ->end()
                            ->prototype('scalar')->end()
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
