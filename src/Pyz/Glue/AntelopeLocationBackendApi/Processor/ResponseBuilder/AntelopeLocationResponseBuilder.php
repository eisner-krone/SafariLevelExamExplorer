<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeLocationBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueErrorTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\AntelopeLocationBackendApiConfig;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationResponseBuilder implements AntelopeLocationResponseBuilderInterface
{
    public function __construct(
        protected readonly AntelopeLocationMapperInterface $antelopeLocationMapper,
    ) {
    }

    public function createAntelopeLocationCollectionResponse(
        AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer,
    ): GlueResponseTransfer {
        $glueResponseTransfer = (new GlueResponseTransfer())->setHttpStatus(Response::HTTP_OK);

        foreach ($antelopeLocationCollectionTransfer->getAntelopeLocations() as $antelopeLocationTransfer) {
            $glueResponseTransfer->addResource($this->createGlueResourceTransfer($antelopeLocationTransfer));
        }

        return $glueResponseTransfer;
    }

    public function createAntelopeLocationResponse(
        AntelopeLocationTransfer $antelopeLocationTransfer,
        int $httpStatus,
    ): GlueResponseTransfer {
        return (new GlueResponseTransfer())
            ->setHttpStatus($httpStatus)
            ->addResource($this->createGlueResourceTransfer($antelopeLocationTransfer));
    }

    public function createNoContentResponse(): GlueResponseTransfer
    {
        return (new GlueResponseTransfer())->setHttpStatus(Response::HTTP_NO_CONTENT);
    }

    public function createErrorResponse(GlueErrorTransfer $glueErrorTransfer): GlueResponseTransfer
    {
        return (new GlueResponseTransfer())
            ->setHttpStatus($glueErrorTransfer->getStatusOrFail())
            ->addError($glueErrorTransfer);
    }

    public function createNotFoundErrorResponse(): GlueResponseTransfer
    {
        return $this->createErrorResponse(
            (new GlueErrorTransfer())
                ->setStatus(Response::HTTP_NOT_FOUND)
                ->setCode(AntelopeLocationBackendApiConfig::ERROR_CODE_ANTELOPE_LOCATION_NOT_FOUND)
                ->setMessage(AntelopeLocationBackendApiConfig::ERROR_MESSAGE_ANTELOPE_LOCATION_NOT_FOUND),
        );
    }

    public function createServerErrorResponse(string $code, string $message): GlueResponseTransfer
    {
        return $this->createErrorResponse(
            (new GlueErrorTransfer())
                ->setStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
                ->setCode($code)
                ->setMessage($message),
        );
    }

    protected function createGlueResourceTransfer(AntelopeLocationTransfer $antelopeLocationTransfer): GlueResourceTransfer
    {
        $attributes = $this->antelopeLocationMapper->mapAntelopeLocationTransferToAntelopeLocationBackendApiAttributes(
            $antelopeLocationTransfer,
            new AntelopeLocationBackendApiAttributesTransfer(),
        );

        return (new GlueResourceTransfer())
            ->setType(AntelopeLocationBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS)
            ->setId((string)$antelopeLocationTransfer->getIdAntelopeLocation())
            ->setAttributes($attributes);
    }
}
