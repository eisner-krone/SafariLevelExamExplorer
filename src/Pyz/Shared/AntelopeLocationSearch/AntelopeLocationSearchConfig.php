<?php

namespace Pyz\Shared\AntelopeLocationSearch;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class AntelopeLocationSearchConfig extends AbstractBundleConfig
{
    /**
     * Specification:
     * - Defines queue name as used for processing AntelopeLocation publish messages.
     *
     * @api
     *
     * @var string
     */
    public const ANTELOPE_LOCATION_PUBLISH_SEARCH_QUEUE = 'publish.search.antelopelocation';

    /**
     * Specification:
     * - Defines queue name as used for processing antelopelocation sync messages.
     *
     * @api
     *
     * @var string
     */
    public const ANTELOPE_LOCATION_SYNC_SEARCH_QUEUE = 'sync.search.antelopelocation';

    /**
     * Specification:
     * - Represents pyz_antelope_location entity creation event.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_ANTELOPE_LOCATION_CREATE = 'Entity.pyz_antelope_location.create';

    /**
     * Specification:
     * - Represents pyz_antelope_location entity change event.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_ANTELOPE_LOCATION_UPDATE = 'Entity.pyz_antelope_location.update';

    /**
     * Specification:
     * - Represents pyz_antelope_location entity deletion event.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_ANTELOPE_LOCATION_DELETE = 'Entity.pyz_antelope_location.delete';

    /**
     * Specification:
     * - This event is used for antelopelocation publishing.
     *
     * @api
     *
     * @var string
     */
    public const ANTELOPE_LOCATION_PUBLISH = 'AntelopeLocationSearch.antelopelocation.publish';

    /**
     * Specification:
     * - This event is used for antelopelocation unpublishing.
     *
     * @api
     */
    public const ANTELOPE_LOCATION_UNPUBLISH = 'AntelopeLocationSearch.antelopelocation.unpublish';
}