<?php
namespace Pyz\Zed\AntelopeLocationDataImport\Business\DataImportStep;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Pyz\Zed\AntelopeDataImport\Business\DataSet\AntelopeDataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeLocationWriterStep implements DataImportStepInterface{
    public function execute(DataSetInterface $dataSet): void{
        $antelopeLocationEntity = PyzAntelopeLocationQuery::create()
        ->filterByName($dataSet[AntelopeLocationDataSetInterface::COLUMN_NAME])
        ->findOneOrCreate();

        $antelopeLocationEntity->setColor($dataSet[AntelopeDataSetInterface::COLUMN_COLOR]);

        if($antelopeLocationEntity->isNew() || $antelopeLocationEntity->isModified()){
            $antelopeLocationEntity->save();
        }
    }
}