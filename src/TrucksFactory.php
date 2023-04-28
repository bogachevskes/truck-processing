<?php

namespace app;

use Ramsey\Uuid\Uuid;

class TrucksFactory
{
    public function __construct(private array $productTypes) { }

    public function createTrucks(int $trucksCount): array
    {
        $trucks = [];

        $cases = $this->productTypes;
        
        do {

            shuffle($cases);

            $trucks[] = new Truck(
                Uuid::uuid4(),
                $cases[0],
                rand(25, 125)
            );

        } while ($trucksCount > count($trucks));

        return $trucks;
    }
}