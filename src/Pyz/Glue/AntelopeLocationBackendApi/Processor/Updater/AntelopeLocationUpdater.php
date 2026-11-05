<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Updater;

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
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;
use Spryker\Shared\Log\LoggerTrait;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationUpdater implements AntelopeLocationUpdaterInterface
{
    use LoggerTrait;

    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected readonly AntelopeLocationMapperInterface $antelopeLocationMapper,
        protected readonly AntelopeLocationValidatorInterface $antelopeLocationValidator,
    ) {
    }

    public function updateAntelopeLocation(
        AntelopeLocationBackendApiAttributesTransfer $antelopeLocationBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $idAntelopeLocation = (int)$glueRequestTransfer->getResourceOrFail()->getId();

        $glueErrorTransfer = $this->antelopeLocationValidator->validate(
            $antelopeLocationBackendApiAttributesTransfer,
            $idAntelopeLocation,
        );
        if ($glueErrorTransfer !== null) {
            return $this->antelopeLocationResponseBuilder->createErrorResponse($glueErrorTransfer);
        }

        $antelopeLocationTransfer = $this->antelopeLocationMapper->mapAntelopeLocationBackendApiAttributesToAntelopeLocationTransfer(
            $antelopeLocationBackendApiAttributesTransfer,
            new AntelopeLocationTransfer(),
        );
        $antelopeLocationTransfer->setIdAntelopeLocation($idAntelopeLocation);

        try {
            $antelopeLocationTransfer = $this->antelopeFacade->updateAntelopeLocation($antelopeLocationTransfer);
        } catch (EntityNotFoundException) {
            return $this->antelopeLocationResponseBuilder->createNotFoundErrorResponse();
        } catch (Exception $exception) {
            $this->getLogger()->error($exception->getMessage(), ['exception' => $exception]);

            return $this->antelopeLocationResponseBuilder->createServerErrorResponse(
                AntelopeLocationBackendApiConfig::ERROR_CODE_ANTELOPE_LOCATION_NOT_UPDATED,
                AntelopeLocationBackendApiConfig::ERROR_MESSAGE_ANTELOPE_LOCATION_NOT_UPDATED,
            );
        }

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(
            $antelopeLocationTransfer,
            Response::HTTP_OK,
        );
    }
}
