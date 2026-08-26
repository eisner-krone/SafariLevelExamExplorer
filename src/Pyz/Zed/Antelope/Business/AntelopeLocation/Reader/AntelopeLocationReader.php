<?php
namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Reader;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepository;

class AntelopeLocationReader
{
    public function __construct(
        protected AntelopeRepository $antelopeRepository
    ) {
    }

    public function getAntelopeLocationById(int $idLocation): ?AntelopeLocationTransfer
    {
        return $this->antelopeRepository->getAntelopeLocationById($idLocation);
    }
}