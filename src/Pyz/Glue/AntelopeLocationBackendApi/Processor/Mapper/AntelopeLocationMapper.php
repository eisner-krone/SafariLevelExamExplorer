<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Mapper;

use Generated\Shared\Transfer\AntelopeLocationBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;

class AntelopeLocationMapper implements AntelopeLocationMapperInterface
{
    /**
     * Only the location name is taken from the request body. The ID always comes from the URL.
     */
    public function mapAntelopeLocationBackendApiAttributesToAntelopeLocationTransfer(
        AntelopeLocationBackendApiAttributesTransfer $antelopeLocationBackendApiAttributesTransfer,
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        return $antelopeLocationTransfer->setLocationName($antelopeLocationBackendApiAttributesTransfer->getLocationName());
    }

    public function mapAntelopeLocationTransferToAntelopeLocationBackendApiAttributes(
        AntelopeLocationTransfer $antelopeLocationTransfer,
        AntelopeLocationBackendApiAttributesTransfer $antelopeLocationBackendApiAttributesTransfer,
    ): AntelopeLocationBackendApiAttributesTransfer {
        return $antelopeLocationBackendApiAttributesTransfer->fromArray($antelopeLocationTransfer->toArray(), true);
    }
}
