<?php

namespace app\strategies;

use App\{
    Truck,
    ProductTypes,
    Warehouse,
};

class CheesePowderUnloadStrategy implements StrategyInterface
{
    public function getProductType(): ProductTypes
    {
        return ProductTypes::TYPE_CHEESE_POWDER;
    }

    public function unload(Truck $item): void
    {
        $capacity = $item->capacity + ($item->capacity / 25) * 4;
        
        $storage = Warehouse::getInstance();

        if ($storage->getSlotFreeSpace($item->type) < $capacity) {
            throw new \LogicException('Отсутствует необходимый свободный объем');
        }

        $storage->loadSlot($item->type, $item->capacity);
    }
}