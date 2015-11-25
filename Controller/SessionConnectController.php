<?php

namespace Emarref\Bundle\ShopifyOAuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SessionConnectController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function redirectToShopifyServiceAction(Request $request)
    {
        $sessionParameters = $request->attributes->get('session_parameters', ['shopify_shop']);
        $service = $this->getParameter('emarref.shopify_oauth.shopify.resource_owner_name');

        foreach ($sessionParameters as $parameterName) {
            $parameterValue = $request->get($parameterName);

            $request->getSession()->set($parameterName, $parameterValue);
        }

        return $this->forward('HWIOAuthBundle:Connect:redirectToService', ['service' => $service]);
    }
}
