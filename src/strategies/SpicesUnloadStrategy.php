<?php

namespace app\strategies;

use App\{
    Truck,
    ProductTypes,
    Warehouse,
};

class SpicesUnloadStrategy implements StrategyInterface
{
    public function getProductType(): ProductTypes
    {
        return ProductTypes::TYPE_SPICES;
    }

    public function unload(Truck $item): void
    {
        $storage = Warehouse::getInstance();

        if ($storage->getSlotFreeSpace($item->type) % $item->capacity) {
            throw new \LogicException('Свободный объем должен быть кратным ' . $item->capacity . ' кг.');
        }

        $storage->loadSlot($item->type, $item->capacity);
    }
}