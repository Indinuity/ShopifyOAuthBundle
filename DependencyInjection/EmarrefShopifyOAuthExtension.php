<?php

namespace Emarref\Bundle\ShopifyOAuthBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class EmarrefShopifyOAuthExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->processConfiguration(new Configuration(), $config);

        $container->setParameter('emarref.shopify_oauth.shopify.resource_owner_name', $configuration['resource_name']);
        $container->setParameter('emarref.shopify_oauth.shopify.api_key', $configuration['shopify']['api_key']);
        $container->setParameter('emarref.shopify_oauth.shopify.secret', $configuration['shopify']['secret']);
        $container->setParameter('emarref.shopify_oauth.shopify.scope', $configuration['shopify']['scope']);

        if ('session' !== $configuration['shop_provider']) {
            $factoryDefinition = $container->getDefinition('emarref.shopify_oauth.resource_owner_factory');
            $factoryDefinition->replaceArgument(0, new Reference($configuration['shop_provider']));
        }
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'emarref_shopify_oauth';
    }
}
