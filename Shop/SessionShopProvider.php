<?php

namespace Emarref\Bundle\ShopifyOAuthBundle\Shop;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionShopProvider implements ShopifyShopAwareInterface
{
    const DEFAULT_PARAMETER_NAME = 'shopify_shop';
    const DEFAULT_SHOPIFY_SHOP   = null;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var string
     */
    private $parameterName;

    /**
     * @var string
     */
    private $defaultShop;

    /**
     * @param SessionInterface $session
     * @param string $parameterName
     * @param null $defaultShop
     */
    public function __construct(
        SessionInterface $session,
        $parameterName = self::DEFAULT_PARAMETER_NAME,
        $defaultShop   = self::DEFAULT_SHOPIFY_SHOP
    ) {
        $this->session       = $session;
        $this->parameterName = $parameterName;
        $this->defaultShop   = $defaultShop;
    }

    /**
     * @return string|null
     */
    public function getShopifyShop()
    {
        return $this->session->get($this->parameterName, $this->defaultShop);
    }
}
