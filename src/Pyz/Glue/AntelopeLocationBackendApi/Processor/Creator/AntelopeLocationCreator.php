<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Creator;

use Exception;
use Generated\Shared\Transfer\AntelopeLocationBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\AntelopeLocationBackendApiConfig;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Validator\AntelopeLocationValidatorInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Shared\Log\LoggerTrait;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationCreator implements AntelopeLocationCreatorInterface
{
    use LoggerTrait;

    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected readonly AntelopeLocationMapperInterface $antelopeLocationMapper,
        protected readonly AntelopeLocationValidatorInterface $antelopeLocationValidator,
    ) {
    }

    public function createAntelopeLocation(
        AntelopeLocationBackendApiAttributesTransfer $antelopeLocationBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $glueErrorTransfer = $this->antelopeLocationValidator->validate($antelopeLocationBackendApiAttributesTransfer);
        if ($glueErrorTransfer !== null) {
            return $this->antelopeLocationResponseBuilder->createErrorResponse($glueErrorTransfer);
        }

        $antelopeLocationTransfer = $this->antelopeLocationMapper->mapAntelopeLocationBackendApiAttributesToAntelopeLocationTransfer(
            $antelopeLocationBackendApiAttributesTransfer,
            new AntelopeLocationTransfer(),
        );

        try {
            $antelopeLocationTransfer = $this->antelopeFacade->createAntelopeLocation($antelopeLocationTransfer);
        } catch (Exception $exception) {
            $this->getLogger()->error($exception->getMessage(), ['exception' => $exception]);

            return $this->antelopeLocationResponseBuilder->createServerErrorResponse(
                AntelopeLocationBackendApiConfig::ERROR_CODE_ANTELOPE_LOCATION_NOT_CREATED,
                AntelopeLocationBackendApiConfig::ERROR_MESSAGE_ANTELOPE_LOCATION_NOT_CREATED,
            );
        }

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(
            $antelopeLocationTransfer,
            Response::HTTP_CREATED,
        );
    }
}
