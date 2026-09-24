<?php

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Communication\Controller;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method AntelopeFacadeInterface getFacade()
 */
class AntelopeLocationController extends AbstractController
{
    /**
     * @param Request $request
     * @return array<string,mixed>
     */
    public function addAction(Request $request): array
    {
        $antelopeLocationTransfer = new AntelopeLocationTransfer();
        $locationName = $request->get('locationName');

        $antelopeLocationTransfer->setLocationName($locationName);
        $this->getFacade()->createAntelopeLocation($antelopeLocationTransfer);

        return $this->viewResponse(['location' => $antelopeLocationTransfer]);
    }

    /**
     * @param Request $request
     * @return array<string,mixed>
     */
    public function getAction(Request $request): array
    {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();

        if ($request->query->has('id')) {
            $antelopeLocationCriteriaTransfer->setIdAntelopeLocation($this->castId($request->query->get('id')));
        }

        if ($request->query->has('locationName')) {
            $antelopeLocationCriteriaTransfer->setLocationName($request->query->get('locationName'));
        }

        $antelopeLocationResponseTransfer = $this->getFacade()->getAntelopeLocation($antelopeLocationCriteriaTransfer);

        return $this->viewResponse(['locationResponse' => $antelopeLocationResponseTransfer]);
    }
}
