<?php

namespace Eheuje\MappingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\Parameter;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link
 * http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     * @throws \RuntimeException
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('eheuje_mapping');
        $rootNode
            ->defaultValue([])
            ->useAttributeAsKey('mapping_name')
            ->prototype('array')
                ->children()
                    ->scalarNode('class')
                        ->defaultValue(new Parameter('eheuje_mapping.mappers.base_mapper.class'))
                    ->end()
//                    ->scalarNode('type')->defaultNull()->end()
                    ->arrayNode('mapping')
                        ->prototype('scalar')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
