<?php

namespace app\strategies;

use App\{
    Truck,
    ProductTypes,
    Warehouse,
};

class TropicalOilsUnloadStrategy implements StrategyInterface
{
    public function getProductType(): ProductTypes
    {
        return ProductTypes::TYPE_TROPICAL_OILS;
    }

    public function unload(Truck $item): void
    {
        $storage = Warehouse::getInstance();

        if ($storage->getSlotFreeSpace($item->type) < $item->capacity) {
            throw new \LogicException('Отсутствует необходимый свободный объем');
        }

        $storage->loadSlot($item->type, $item->capacity);
    }
}