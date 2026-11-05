<?php
namespace Pyz\Zed\AntelopeLocationDataImport\Business\DataImportStep;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Pyz\Zed\AntelopeLocationDataImport\Business\DataSet\AntelopeLocationDataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeLocationWriterStep implements DataImportStepInterface{
    public function execute(DataSetInterface $dataSet): void{
        $antelopeLocationEntity = PyzAntelopeLocationQuery::create()
        ->filterByLocationName($dataSet[AntelopeLocationDataSetInterface::COLUMN_NAME])
        ->findOneOrCreate();

        $antelopeLocationEntity->setLatitude((float)$dataSet[AntelopeLocationDataSetInterface::COLUMN_LATITUDE]);
        $antelopeLocationEntity->setLongitude((float)$dataSet[AntelopeLocationDataSetInterface::COLUMN_LONGITUDE]);

        if($antelopeLocationEntity->isNew() || $antelopeLocationEntity->isModified()){
            $antelopeLocationEntity->save();
        }
    }
}
