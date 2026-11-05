<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Validator;

use Generated\Shared\Transfer\AntelopeLocationBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\GlueErrorTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\AntelopeLocationBackendApiConfig;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationValidator implements AntelopeLocationValidatorInterface
{
    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeFacade,
    ) {
    }

    /**
     * @param int|null $idAntelopeLocation The location being updated; it may keep its own name.
     */
    public function validate(
        AntelopeLocationBackendApiAttributesTransfer $antelopeLocationBackendApiAttributesTransfer,
        ?int $idAntelopeLocation = null,
    ): ?GlueErrorTransfer {
        $locationName = trim((string)$antelopeLocationBackendApiAttributesTransfer->getLocationName());

        if ($locationName === '') {
            return $this->createValidationError(
                AntelopeLocationBackendApiConfig::ERROR_CODE_LOCATION_NAME_MISSING,
                AntelopeLocationBackendApiConfig::ERROR_MESSAGE_LOCATION_NAME_MISSING,
            );
        }

        if (mb_strlen($locationName) > AntelopeLocationBackendApiConfig::LOCATION_NAME_MAX_LENGTH) {
            return $this->createValidationError(
                AntelopeLocationBackendApiConfig::ERROR_CODE_LOCATION_NAME_TOO_LONG,
                sprintf(
                    AntelopeLocationBackendApiConfig::ERROR_MESSAGE_LOCATION_NAME_TOO_LONG,
                    AntelopeLocationBackendApiConfig::LOCATION_NAME_MAX_LENGTH,
                ),
            );
        }

        if ($this->isLocationNameTaken($locationName, $idAntelopeLocation)) {
            return $this->createValidationError(
                AntelopeLocationBackendApiConfig::ERROR_CODE_LOCATION_NAME_ALREADY_EXISTS,
                AntelopeLocationBackendApiConfig::ERROR_MESSAGE_LOCATION_NAME_ALREADY_EXISTS,
            );
        }

        return null;
    }

    protected function isLocationNameTaken(string $locationName, ?int $idAntelopeLocation): bool
    {
        $antelopeLocationCollectionTransfer = $this->antelopeFacade->getAntelopeLocationCollection(
            (new AntelopeLocationCriteriaTransfer())->setLocationName($locationName),
        );

        foreach ($antelopeLocationCollectionTransfer->getAntelopeLocations() as $antelopeLocationTransfer) {
            if ($antelopeLocationTransfer->getIdAntelopeLocation() !== $idAntelopeLocation) {
                return true;
            }
        }

        return false;
    }

    protected function createValidationError(string $code, string $message): GlueErrorTransfer
    {
        return (new GlueErrorTransfer())
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setCode($code)
            ->setMessage($message);
    }
}
