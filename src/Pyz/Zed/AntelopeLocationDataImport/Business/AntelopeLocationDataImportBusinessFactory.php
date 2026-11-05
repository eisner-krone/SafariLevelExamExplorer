<?php

namespace Pyz\Zed\AntelopeLocationDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeDataImport\Business\DataImportStep\AntelopeWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;

use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;
class AntelopeLocationDataImportBusinessFactory extends DataImportBusinessFactory
{
    public function createAntelopeLocationDataImport(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterInterface{

        $dataImporter = $this->getCsvDataImporterFromConfig($dataImporterConfigurationTransfer);

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep($this->createAntelopeWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    public function createAntelopeLocationWriterStep(): AntelopeLocationWriterStep{
        return new AntelopeLocationWriterStep();
    }
}