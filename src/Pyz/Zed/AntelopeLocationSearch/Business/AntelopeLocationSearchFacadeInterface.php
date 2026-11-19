<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business;

interface AntelopeLocationSearchFacadeInterface
{
    /**
     * Specification:
     * - Retrieves all antelope locations using IDs from $eventEntityTransfers.
     * - Updates entities from `pyz_antelope_location_search` with actual data from obtained antelope locations.
     * - Sends a copy of data to queue based on module config.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     *
     * @return void
     */
    public function writeCollectionByAntelopeLocationEvents(array $eventEntityTransfers): void;
}
