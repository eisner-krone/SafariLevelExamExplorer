<?php

namespace Pyz\Yves\AntelopePage\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Spryker\Yves\Kernel\View\View;
use SprykerShop\Yves\ShopApplication\Controller\AbstractController;

/**
 * @method \Pyz\Yves\AntelopePage\AntelopePageFactory getFactory()
 */
class AntelopeController extends AbstractController
{
    public function getAction(string $name): View
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $antelopeCriteriaTransfer->setName($name);

        $antelopeResponseTransfer = $this->getFactory()
            ->getAntelopeClient()
            ->getAntelope($antelopeCriteriaTransfer);

        return $this->view(
            ['antelope' => $antelopeResponseTransfer->getAntelope()],
            [],
            '@AntelopePage/views/antelope/get.twig'
        );
    }

    public function getLocationAction(string $locationName): View
    {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $antelopeLocationCriteriaTransfer->setLocationName($locationName);

        $antelopeLocationResponseTransfer = $this->getFactory()
            ->getAntelopeClient()
            ->getAntelopeLocation($antelopeLocationCriteriaTransfer);

        return $this->view(
            ['antelopeLocation' => $antelopeLocationResponseTransfer->getAntelopeLocation()],
            [],
            '@AntelopePage/views/antelope-location/get.twig'
        );
    }
}
