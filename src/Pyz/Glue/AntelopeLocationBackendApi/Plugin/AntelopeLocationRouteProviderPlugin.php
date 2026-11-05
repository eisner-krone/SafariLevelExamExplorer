<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Plugin;

use Pyz\Glue\AntelopeLocationBackendApi\AntelopeLocationBackendApiConfig;
use Pyz\Glue\AntelopeLocationBackendApi\Controller\AntelopeLocationResourceController;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RouteProviderPluginInterface;
use Spryker\Glue\Kernel\Backend\AbstractPlugin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class AntelopeLocationRouteProviderPlugin extends AbstractPlugin implements RouteProviderPluginInterface
{
    /**
     * @var string
     */
    protected const ROUTE_NAME_PUT = 'antelope-locationsResourcePut';

    /**
     * @var string
     */
    protected const ROUTE_PATH_ID = '/%s/{id}';

    /**
     * @inheritDoc
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $route = (new Route(sprintf(static::ROUTE_PATH_ID, AntelopeLocationBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS)))
            ->setDefault('_controller', [AntelopeLocationResourceController::class, 'putAction'])
            ->setDefault('_method', Request::METHOD_PUT)
            ->setMethods(Request::METHOD_PUT);

        $routeCollection->add(static::ROUTE_NAME_PUT, $route);

        return $routeCollection;
    }
}
