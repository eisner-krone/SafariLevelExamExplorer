<?php
namespace Pyz\Zed\AntelopeLocationSearch\Business;
use Pyz\Zed\AntelopeLocationSearch\AntelopeLocationSearchDependencyProvider;
use Pyz\Zed\AntelopeLocationSearch\Business\Writer\AntelopeLocationSearchWriter;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class AntelopeLocationSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\AntelopeLocationSearch\Business\Writer\AntelopeLocationSearchWriter
     */
    public function createAntelopeLocationSearchWriter()
    {
        return new AntelopeLocationSearchWriter(
            $this->getEventBehaviorFacade(),
        );
    }

    /**
     * @return \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): EventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeLocationSearchDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}