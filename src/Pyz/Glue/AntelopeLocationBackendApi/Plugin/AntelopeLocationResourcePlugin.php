<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Plugin;

use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\AntelopeLocationBackendApiConfig;
use Pyz\Glue\AntelopeLocationBackendApi\Controller\AntelopeLocationResourceController;
use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;

/**
 * PUT is not supported by `GlueResourceMethodCollectionTransfer`,
 * so it is registered separately in {@link AntelopeLocationRouteProviderPlugin}.
 */
class AntelopeLocationResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return AntelopeLocationBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS;
    }

    /**
     * @inheritDoc
     */
    public function getController(): string
    {
        return AntelopeLocationResourceController::class;
    }

    /**
     * @inheritDoc
     */
    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        return (new GlueResourceMethodCollectionTransfer())
            ->setGetCollection(new GlueResourceMethodConfigurationTransfer())
            ->setGet(new GlueResourceMethodConfigurationTransfer())
            ->setPost(new GlueResourceMethodConfigurationTransfer())
            ->setDelete(new GlueResourceMethodConfigurationTransfer());
    }
}
