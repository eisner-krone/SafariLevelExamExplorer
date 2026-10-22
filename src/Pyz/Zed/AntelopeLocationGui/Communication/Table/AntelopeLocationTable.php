<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication\Table;

use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeLocationTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocation;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeLocationTable extends AbstractTable
{
    public const string COL_ID_ANTELOPE_LOCATION = PyzAntelopeLocationTableMap::COL_ID_ANTELOPE_LOCATION;
    public const string COL_LOCATION_NAME = PyzAntelopeLocationTableMap::COL_LOCATION_NAME;
    public const string COL_ACTIONS = 'actions';

    protected const string URL_ANTELOPE_LOCATION_EDIT = '/antelope-location-gui/index/edit';
    protected const string PARAM_ID_ANTELOPE_LOCATION = 'id';

    public function __construct(protected PyzAntelopeLocationQuery $antelopeLocationQuery)
    {
    }

    /**
     * @param TableConfiguration $config
     *
     * @return TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            static::COL_ID_ANTELOPE_LOCATION => 'Location ID',
            static::COL_LOCATION_NAME => 'Name',
            static::COL_ACTIONS => 'Actions',
        ]);

        $config->setSortable([
            static::COL_ID_ANTELOPE_LOCATION,
            static::COL_LOCATION_NAME,
        ]);

        $config->setSearchable([
            static::COL_ID_ANTELOPE_LOCATION,
            static::COL_LOCATION_NAME,
        ]);

        $config->setRawColumns([
            static::COL_ACTIONS,
        ]);

        return $config;
    }

    /**
     * @param TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config): array
    {
        $antelopeLocationEntityCollection = $this->runQuery(
            $this->antelopeLocationQuery,
            $config,
            true
        );

        if (!$antelopeLocationEntityCollection->count()) {
            return [];
        }

        return $this->mapReturns($antelopeLocationEntityCollection);
    }

    /**
     * @param ObjectCollection<PyzAntelopeLocation> $antelopeLocationEntityCollection
     *
     * @return array<int,mixed>
     */
    protected function mapReturns(ObjectCollection $antelopeLocationEntityCollection
    ): array {
        $returns = [];

        foreach ($antelopeLocationEntityCollection as $antelopeLocationEntity) {
            $returns[] = [
                static::COL_ID_ANTELOPE_LOCATION => $antelopeLocationEntity->getIdAntelopeLocation(),
                static::COL_LOCATION_NAME => $antelopeLocationEntity->getLocationName(),
                static::COL_ACTIONS => $this->generateEditButton(
                    Url::generate(static::URL_ANTELOPE_LOCATION_EDIT, [
                        static::PARAM_ID_ANTELOPE_LOCATION => $antelopeLocationEntity->getIdAntelopeLocation(),
                    ]),
                    'Edit'
                ),
            ];
        }

        return $returns;
    }
}
