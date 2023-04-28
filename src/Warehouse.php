<?php

namespace app;

class Warehouse
{
    private static ?self $instance = null;

    private array $slots = [];

    private function __construct() { }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __clone(): never
    {
        throw new \LogicException('Хранилище не может быть клонировано');
    }

    public static function getSlots(): array
    {
        return self::$instance->slots;
    }

    private function addSlot(Slot $slot): void
    {
        $this->slots[$slot->type->name] = $slot;
    }

    public static function loadSlotsOnce(array $slots = []): void
    {
        $instance = self::getInstance();
        
        if (empty($instance->slots) === false) {
            throw new \LogicException('Товары загружены ранее');
        }

        foreach ($slots as $slot) {
            $instance->addSlot($slot);
        }
    }

    public function getSlotFreeSpace(ProductTypes $type): int
    {
        if (isset($this->slots[$type->name]) === false) {
            return 0;
        }

        return $this->slots[$type->name]->freeSpace;
    }

    public function loadSlot(ProductTypes $type, int $capacity): void
    {
        if (isset($this->slots[$type->name]) === false) {
            throw new \LogicException('Слот отсутствует');
        }

        if ($this->slots[$type->name]->freeSpace < $capacity) {
            throw new \LogicException('Объем ' . $capacity . '. Не может быть загружен. Доступно: ' . $this->slots[$type]->freeSpace);
        }
        
        $this->slots[$type->name]->freeSpace -= $capacity;
    }
}