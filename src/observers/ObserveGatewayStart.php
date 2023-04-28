<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

use app\Warehouse;

class ObserveGatewayStart implements ObserverInterface
{
    public function observe(Message $message): void
    {
        $data = $message->getMessage();

        echo 'Доступен склад.<br>Слоты размещения склада:<br>';
        echo '<br>';

        foreach (Warehouse::getSlots() as $slot) {
            echo 'Тип хранения: ' . $slot->type->value . '<br>';
            echo 'Доступный объем: ' . $slot->freeSpace . ' кг.<br>';
            echo '<br>';
        }

        echo '<br>';

        $trucks = $data['item']->trucks;
        
        echo 'Запуск обработки грузовиков.<br>Всего грузовиков: ' . count($trucks) . '<br>';
        echo '<br>';
        echo 'Грузовики:<br>';
        echo '<br>';

        foreach ($trucks as $truck) {
            echo 'ID: ' . $truck->id . '<br>';
            echo 'Груз: ' . $truck->type->value . '<br>';
            echo 'Объем: ' . $truck->capacity . ' кг.<br>';
            echo '<br>';
        }
    }
}