<?php

namespace Emarref\Bundle\ShopifyOAuthBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EmarrefShopifyOAuthBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (!$this->extension) {
            $class = $this->getContainerExtensionClass();
            $this->extension = new $class;
        }

        return $this->extension;
    }
}
