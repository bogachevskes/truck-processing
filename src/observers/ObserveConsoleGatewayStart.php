<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

use app\Warehouse;

class ObserveConsoleGatewayStart implements ObserverInterface
{
    public function observe(Message $message): void
    {
        $data = $message->getMessage();

        echo "\033[0;32mДоступен склад." . PHP_EOL . "Слоты размещения склада:\033[0m" . PHP_EOL;

        echo PHP_EOL;

        foreach (Warehouse::getSlots() as $slot) {
            echo "\033[0;36mТип хранения: " . $slot->type->value . PHP_EOL;
            echo 'Доступный объем: ' . $slot->freeSpace . " кг.\033[0m" . PHP_EOL;
            echo PHP_EOL;
        }

        echo PHP_EOL;

        $trucks = $data['item']->trucks;
        
        echo "\033[0;32mЗапуск обработки грузовиков." . PHP_EOL . 'Всего грузовиков: ' . count($trucks) . "\033[0m" . PHP_EOL;
        echo PHP_EOL;
        echo "\033[0;36mГрузовики:\033[0m" . PHP_EOL;
        echo PHP_EOL;

        foreach ($trucks as $truck) {
            echo "\033[0;36m";
            echo 'ID: ' . $truck->id . PHP_EOL;
            echo 'Груз: ' . $truck->type->value . PHP_EOL;
            echo 'Объем: ' . $truck->capacity . " кг.\033[0m" . PHP_EOL;
            echo PHP_EOL;
        }
    }
}