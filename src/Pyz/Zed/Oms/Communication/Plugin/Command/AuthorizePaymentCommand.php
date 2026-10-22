<?php

namespace Pyz\Zed\Oms\Communication\Plugin\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface;

class AuthorizePaymentCommand extends AbstractPlugin implements CommandByOrderInterface
{
    public function run(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array
    {
        // Simulation der Zahlungsautorisierung
        error_log(sprintf('Authorizing payment for order %s', $orderEntity->getOrderReference()));

        return [];
    }
}
