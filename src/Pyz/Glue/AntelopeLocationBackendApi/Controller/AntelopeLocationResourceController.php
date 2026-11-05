<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationBackendApi\Controller;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Spryker\Glue\Kernel\Backend\Controller\AbstractController;

/**
 * @method \Pyz\Glue\AntelopeLocationBackendApi\AntelopeLocationBackendApiFactory getFactory()
 */
class AntelopeLocationResourceController extends AbstractController
{
    public function getCollectionAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return new GlueResponseTransfer();
    }

    public function getAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return new GlueResponseTransfer();
    }

    public function postAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return new GlueResponseTransfer();
    }

    public function putAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return new GlueResponseTransfer();
    }

    public function deleteAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return new GlueResponseTransfer();
    }
}
