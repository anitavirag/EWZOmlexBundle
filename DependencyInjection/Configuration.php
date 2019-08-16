<?php

namespace EWZ\Bundle\OmlexBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('ewz_omlex');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('providers')
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
