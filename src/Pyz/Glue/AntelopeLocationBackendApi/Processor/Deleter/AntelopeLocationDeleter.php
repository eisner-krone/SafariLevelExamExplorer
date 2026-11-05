<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Deleter;

use Exception;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\AntelopeLocationBackendApiConfig;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;
use Spryker\Shared\Log\LoggerTrait;

class AntelopeLocationDeleter implements AntelopeLocationDeleterInterface
{
    use LoggerTrait;

    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
    ) {
    }

    public function deleteAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())
            ->setIdAntelopeLocation((int)$glueRequestTransfer->getResourceOrFail()->getId());

        try {
            $this->antelopeFacade->deleteAntelopeLocation($antelopeLocationTransfer);
        } catch (EntityNotFoundException) {
            return $this->antelopeLocationResponseBuilder->createNotFoundErrorResponse();
        } catch (Exception $exception) {
            $this->getLogger()->error($exception->getMessage(), ['exception' => $exception]);

            return $this->antelopeLocationResponseBuilder->createServerErrorResponse(
                AntelopeLocationBackendApiConfig::ERROR_CODE_ANTELOPE_LOCATION_NOT_DELETED,
                AntelopeLocationBackendApiConfig::ERROR_MESSAGE_ANTELOPE_LOCATION_NOT_DELETED,
            );
        }

        return $this->antelopeLocationResponseBuilder->createNoContentResponse();
    }
}
