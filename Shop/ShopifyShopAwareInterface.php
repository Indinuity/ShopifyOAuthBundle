<?php

namespace Emarref\Bundle\ShopifyOAuthBundle\Shop;

interface ShopifyShopAwareInterface
{
    /**
     * @return string
     */
    public function getShopifyShop();
}
