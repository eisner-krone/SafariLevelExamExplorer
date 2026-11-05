<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Deleter;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeLocationDeleter implements AntelopeLocationDeleterInterface
{
    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
    ) {
    }

    public function deleteAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())
            ->setIdAntelopeLocation((int)$glueRequestTransfer->getResourceOrFail()->getId());

        $this->antelopeFacade->deleteAntelopeLocation($antelopeLocationTransfer);

        return $this->antelopeLocationResponseBuilder->createNoContentResponse();
    }
}
