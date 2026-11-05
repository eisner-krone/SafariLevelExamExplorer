<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueErrorTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeLocationResponseBuilderInterface
{
    public function createAntelopeLocationCollectionResponse(
        AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer,
    ): GlueResponseTransfer;

    public function createAntelopeLocationResponse(
        AntelopeLocationTransfer $antelopeLocationTransfer,
        int $httpStatus,
    ): GlueResponseTransfer;

    public function createNoContentResponse(): GlueResponseTransfer;

    public function createErrorResponse(GlueErrorTransfer $glueErrorTransfer): GlueResponseTransfer;

    public function createNotFoundErrorResponse(): GlueResponseTransfer;

    public function createServerErrorResponse(string $code, string $message): GlueResponseTransfer;
}
