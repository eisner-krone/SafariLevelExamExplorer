<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Validator;

use Generated\Shared\Transfer\AntelopeLocationBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueErrorTransfer;

interface AntelopeLocationValidatorInterface
{
    /**
     * Returns `null` when the attributes are valid.
     */
    public function validate(
        AntelopeLocationBackendApiAttributesTransfer $antelopeLocationBackendApiAttributesTransfer,
        ?int $idAntelopeLocation = null,
    ): ?GlueErrorTransfer;
}
