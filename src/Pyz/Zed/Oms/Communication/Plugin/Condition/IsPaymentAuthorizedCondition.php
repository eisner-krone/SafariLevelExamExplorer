<?php

namespace Pyz\Zed\Oms\Communication\Plugin\Condition;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;

class IsPaymentAuthorizedCondition extends AbstractPlugin implements ConditionInterface
{
    public function check(SpySalesOrderItem $orderItem): bool
    {
        // Simulation: Autorisierung schlägt fehl, wenn die Kunden-Mail "fail" enthält
        return !str_contains($orderItem->getOrder()->getEmail(), 'fail');
    }
}