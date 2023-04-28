<?php

namespace app;

class Slot
{
    public function __construct(
        public readonly ProductTypes $type,
        public int $freeSpace,
    ) { }
}