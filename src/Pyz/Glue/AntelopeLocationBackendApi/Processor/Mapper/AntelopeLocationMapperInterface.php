<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Mapper;

use Generated\Shared\Transfer\AntelopeLocationBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;

interface AntelopeLocationMapperInterface
{
    public function mapAntelopeLocationBackendApiAttributesToAntelopeLocationTransfer(
        AntelopeLocationBackendApiAttributesTransfer $antelopeLocationBackendApiAttributesTransfer,
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer;

    public function mapAntelopeLocationTransferToAntelopeLocationBackendApiAttributes(
        AntelopeLocationTransfer $antelopeLocationTransfer,
        AntelopeLocationBackendApiAttributesTransfer $antelopeLocationBackendApiAttributesTransfer,
    ): AntelopeLocationBackendApiAttributesTransfer;
}
