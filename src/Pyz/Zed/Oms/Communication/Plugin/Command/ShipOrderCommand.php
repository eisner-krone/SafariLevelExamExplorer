<?php

namespace Pyz\Zed\Oms\Communication\Plugin\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface;

class ShipOrderCommand extends AbstractPlugin implements CommandByOrderInterface
{
    public function run(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array
    {
        // Simulation des Versandprozesses
        error_log(sprintf('Shipping order %s', $orderEntity->getOrderReference()));

        return [];
    }
}
