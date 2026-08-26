<?php
namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Writer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

class AntelopeLocationWriter
{
    public function __construct(
        protected AntelopeEntityManagerInterface $antelopeEntityManager
    ) {
    }

    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        return $this->antelopeEntityManager->createAntelopeLocation($antelopeLocationTransfer);
    }
}