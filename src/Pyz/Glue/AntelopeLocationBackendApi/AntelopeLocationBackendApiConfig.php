<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationBackendApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class AntelopeLocationBackendApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_ANTELOPE_LOCATIONS = 'antelope-locations';

    /**
     * Must match the `size` of `location_name` in `pyz_antelope.schema.xml`.
     *
     * @var int
     */
    public const LOCATION_NAME_MAX_LENGTH = 120;

    /**
     * @var string
     */
    public const ERROR_CODE_ANTELOPE_LOCATION_NOT_FOUND = '5501';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_ANTELOPE_LOCATION_NOT_FOUND = 'Antelope location not found.';

    /**
     * @var string
     */
    public const ERROR_CODE_LOCATION_NAME_MISSING = '5502';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_LOCATION_NAME_MISSING = 'Location name is required.';

    /**
     * @var string
     */
    public const ERROR_CODE_LOCATION_NAME_TOO_LONG = '5503';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_LOCATION_NAME_TOO_LONG = 'Location name must not be longer than %d characters.';

    /**
     * @var string
     */
    public const ERROR_CODE_LOCATION_NAME_ALREADY_EXISTS = '5504';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_LOCATION_NAME_ALREADY_EXISTS = 'Location name already exists.';

    /**
     * @var string
     */
    public const ERROR_CODE_ANTELOPE_LOCATION_NOT_CREATED = '5505';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_ANTELOPE_LOCATION_NOT_CREATED = 'Antelope location could not be created.';

    /**
     * @var string
     */
    public const ERROR_CODE_ANTELOPE_LOCATION_NOT_UPDATED = '5506';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_ANTELOPE_LOCATION_NOT_UPDATED = 'Antelope location could not be updated.';

    /**
     * @var string
     */
    public const ERROR_CODE_ANTELOPE_LOCATION_NOT_DELETED = '5507';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_ANTELOPE_LOCATION_NOT_DELETED = 'Antelope location could not be deleted.';
}
