<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Reader;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationReader implements AntelopeLocationReaderInterface
{
    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
    ) {
    }

    public function getAntelopeLocationCollection(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationCollectionTransfer = $this->antelopeFacade->getAntelopeLocationCollection(
            new AntelopeLocationCriteriaTransfer(),
        );

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationCollectionResponse($antelopeLocationCollectionTransfer);
    }

    public function getAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationCriteriaTransfer = (new AntelopeLocationCriteriaTransfer())
            ->setIdAntelopeLocation((int)$glueRequestTransfer->getResourceOrFail()->getId());

        $antelopeLocationTransfer = $this->antelopeFacade
            ->getAntelopeLocation($antelopeLocationCriteriaTransfer)
            ->getAntelopeLocationOrFail();

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(
            $antelopeLocationTransfer,
            Response::HTTP_OK,
        );
    }
}
