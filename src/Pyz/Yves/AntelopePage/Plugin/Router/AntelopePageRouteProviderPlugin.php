<?php

namespace Pyz\Yves\AntelopePage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class AntelopePageRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    public const string ROUTE_NAME_ANTELOPE_NAME = '/antelope/_name_';

    public const string ROUTE_NAME_ANTELOPE_LOCATION_NAME = '/antelope-location/_locationName_';

    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addAntelopeAntelopeGetRoute($routeCollection);
        $routeCollection = $this->addAntelopeLocationGetRoute($routeCollection);

        return $routeCollection;
    }

    private function addAntelopeLocationGetRoute(
        RouteCollection $routeCollection
    ): RouteCollection {
        $route = $this->buildRoute('/antelope-location/{locationName}', 'AntelopePage',
            'Antelope', 'getLocationAction');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(static::ROUTE_NAME_ANTELOPE_LOCATION_NAME,
            $route);

        return $routeCollection;
    }

    private function addAntelopeAntelopeGetRoute(
        RouteCollection $routeCollection
    ): RouteCollection {
        $route = $this->buildRoute('/antelope/{name}', 'AntelopePage',
            'Antelope', 'getAction');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(static::ROUTE_NAME_ANTELOPE_NAME,
            $route);

        return $routeCollection;
    }
}
