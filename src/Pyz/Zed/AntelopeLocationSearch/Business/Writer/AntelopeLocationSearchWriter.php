<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business\Writer;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Orm\Zed\AntelopeLocationSearch\Persistence\PyzAntelopeLocationSearchQuery;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class AntelopeLocationSearchWriter
{
    /**
     * @var \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected $eventBehaviorFacade;

    /**
     * @param \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface $eventBehaviorFacade
     */
    public function __construct(EventBehaviorFacadeInterface $eventBehaviorFacade)
    {
        $this->eventBehaviorFacade = $eventBehaviorFacade;
    }

    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     *
     * @return void
     */
    public function writeCollectionByAntelopeLocationEvents(array $eventEntityTransfers): void
    {
        $antelopeLocationIds = $this->eventBehaviorFacade->getEventTransferIds($eventEntityTransfers);

        $this->writeCollectionByAntelopeLocationIds($antelopeLocationIds);
    }

    /**
     * @param array<int> $antelopeLocationIds
     *
     * @return void
     */
    protected function writeCollectionByAntelopeLocationIds(array $antelopeLocationIds): void
    {
        if (!$antelopeLocationIds) {
            return;
        }

        // Training: persistence logic kept in Business layer to focus on P&S.
        $antelopeLocationEntities = PyzAntelopeLocationQuery::create()
            ->filterByIdAntelopeLocation_In($antelopeLocationIds)
            ->find();

        foreach ($antelopeLocationEntities as $antelopeLocationEntity) {
            $antelopeLocationSearchEntity = PyzAntelopeLocationSearchQuery::create()
                ->filterByFkAntelopeLocation($antelopeLocationEntity->getIdAntelopeLocation())
                ->findOneOrCreate();

            $antelopeLocationSearchEntity->setData($antelopeLocationEntity->toArray());
            $antelopeLocationSearchEntity->save();
        }
    }
}
