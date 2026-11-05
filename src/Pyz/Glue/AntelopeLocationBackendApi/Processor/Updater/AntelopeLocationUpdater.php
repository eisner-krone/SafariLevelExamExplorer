<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopeLocationBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationUpdater implements AntelopeLocationUpdaterInterface
{
    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected readonly AntelopeLocationMapperInterface $antelopeLocationMapper,
    ) {
    }

    public function updateAntelopeLocation(
        AntelopeLocationBackendApiAttributesTransfer $antelopeLocationBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationTransfer = $this->antelopeLocationMapper->mapAntelopeLocationBackendApiAttributesToAntelopeLocationTransfer(
            $antelopeLocationBackendApiAttributesTransfer,
            new AntelopeLocationTransfer(),
        );
        $antelopeLocationTransfer->setIdAntelopeLocation((int)$glueRequestTransfer->getResourceOrFail()->getId());

        $antelopeLocationTransfer = $this->antelopeFacade->updateAntelopeLocation($antelopeLocationTransfer);

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(
            $antelopeLocationTransfer,
            Response::HTTP_OK,
        );
    }
}
