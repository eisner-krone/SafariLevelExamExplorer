<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\AntelopeLocationSearch\Business\AntelopeLocationSearchBusinessFactory getFactory()
 */
class AntelopeLocationSearchFacade extends AbstractFacade implements AntelopeLocationSearchFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     *
     * @return void
     */
    public function writeCollectionByAntelopeLocationEvents(array $eventEntityTransfers): void
    {
        $this->getFactory()
            ->createAntelopeLocationSearchWriter()
            ->writeCollectionByAntelopeLocationEvents($eventEntityTransfers);
    }
}
