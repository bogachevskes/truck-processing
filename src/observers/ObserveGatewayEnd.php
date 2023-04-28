<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

use app\Warehouse;

class ObserveGatewayEnd implements ObserverInterface
{
    public function observe(Message $message): void
    {
        echo '<br>';

        echo 'Загрузка складов выполнена.<br>Текущее состояния слотов размещения:<br>';
        echo '<br>';

        foreach (Warehouse::getSlots() as $slot) {
            echo 'Груз: ' . $slot->type->value . '<br>';
            echo 'Доступный объем: ' . $slot->freeSpace . '<br>';
            echo '<br>';
        }
    }
}