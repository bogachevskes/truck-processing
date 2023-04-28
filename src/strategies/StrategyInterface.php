<?php

namespace app\strategies;

use App\{
    Truck,
    ProductTypes,
};

interface StrategyInterface
{
    function getProductType(): ProductTypes;

    function unload(Truck $item): void;
}