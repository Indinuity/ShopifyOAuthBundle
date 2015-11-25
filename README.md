This bundle provides a Shopify resource owner for [HWIOauthBundle](https://github.com/hwi/HWIOAuthBundle) where the
Shopify shop is provided at runtime by the end user. It allows a user to connect to their own Shopify shop.

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require emarref/shopify-oauth-bundle "~1.0.0"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Emarref\Bundle\ShopifyOAuthBundle\EmarrefShopifyOAuthBundle(),
        );

        // ...
    }

    // ...
}
```

Step 3: Configure
-----------------

```yaml
# app/config/config.yml

emarref_shopify_oauth:
    shopify:
        api_key: <shopify_api_key>
        secret:  <shopify_secret>
        scope:   "<scope_1>[,<scope_2>]"

hwi_oauth:
    [...]
    resource_owners:
        shopify:
            service: emarref.shopify_oauth.resource_owner
```

Step 4: Usage
-------------

The service configured above extracts a `shopify_shop` value from the session. It's up to you how that value is entered
into the session. However, this bundle ships with a controller that handles a likely scenario of requesting a URL
containing a `?shopify_shop=myshop.myshopify.com` query parameter. This controller will take the shopify_shop value,
place it into the session, then forward the request to the HWIOAuthBundle for redirection. Simply set up your route
to take advantage of it.

```yaml
# app/config/routing.yml

emarref_shopify_oauth_connect:
    resource: "@EmarrefShopifyOAuthBundle/Resources/config/routing.yml"
    prefix: /connect/shopify
```

Now any request for `/connect/shopify?shopify_shop=myshop.myshopify.com` will initiate the HWIOAuthBundle redirect for
that shop.
