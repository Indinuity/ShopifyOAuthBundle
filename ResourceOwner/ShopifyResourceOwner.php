<?php

namespace Emarref\Bundle\ShopifyOAuthBundle\ResourceOwner;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GenericOAuth2ResourceOwner;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ShopifyResourceOwner extends GenericOAuth2ResourceOwner
{
    /**
     * {@inheritDoc}
     */
    protected $paths = array(
        'identifier' => 'shop.id',
        'nickname'   => 'shop.name',
        'realname'   => 'shop.shop_owner',
        'email'      => 'shop.email',
    );

    /**
     * {@inheritDoc}
     */
    protected function configureOptions(OptionsResolverInterface $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setRequired('base_url');

        $resolver->setDefaults(array(
            'authorization_url'        => '{base_url}/admin/oauth/authorize',
            'access_token_url'         => '{base_url}/admin/oauth/access_token',
            'infos_url'                => '{base_url}/admin/shop.json',
            'use_bearer_authorization' => false,
        ));

        $baseUrlNormalizer = function (Options $options, $value) {
            return strtr($value, [
                '{base_url}' => $options['base_url']
            ]);
        };

        $resolver->setNormalizers([
            'authorization_url' => $baseUrlNormalizer,
            'access_token_url'  => $baseUrlNormalizer,
            'infos_url'         => $baseUrlNormalizer,
        ]);
    }
}
