<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

use app\Warehouse;

class ObserveConsoleGatewayEnd implements ObserverInterface
{
    public function observe(Message $message): void
    {
        echo PHP_EOL;

        echo "\033[0;32mЗагрузка складов выполнена.\033[0m" . PHP_EOL;
        echo PHP_EOL;
        echo "\033[0;36mТекущее состояния слотов размещения:" . PHP_EOL;
        
        echo PHP_EOL;

        foreach (Warehouse::getSlots() as $slot) {
            echo 'Груз: ' . $slot->type->value . PHP_EOL;
            echo 'Доступный объем: ' . $slot->freeSpace . PHP_EOL;
            echo PHP_EOL;
        }

        echo "\033[0m";
    }
}