<?php

namespace app;

class Truck
{
    public function __construct(
        public readonly string $id,
        public readonly ProductTypes $type,
        public readonly int $capacity,
    ) { }
}