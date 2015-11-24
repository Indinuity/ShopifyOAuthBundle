<?php

namespace Emarref\Bundle\ShopifyOAuthBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $root = $builder->root('emarref_shopify_oauth');

        $root
            ->children()
                ->scalarNode('resource_name')->defaultValue('shopify')->end()
                ->scalarNode('shop_provider')->defaultValue('session')->end()
                ->arrayNode('shopify')
                    ->children()
                        ->scalarNode('api_key')->isRequired()->end()
                        ->scalarNode('secret')->isRequired()->end()
                        ->scalarNode('scope')->defaultValue('')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $builder;
    }
}
