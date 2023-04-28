<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveConsoleProcessTruckDone implements ObserverInterface
{
    public function observe(Message $message): void
    {
        $data = $message->getMessage();
        
        echo "\033[0;32mВыполнена разгрузка грузовика: " . $data['item']->id . PHP_EOL;
        echo 'Доставлен груз ' . $data['item']->type->value . ' в объеме ' . $data['item']->capacity  . " кг.\033[0m" . PHP_EOL;
        echo PHP_EOL;
    }
}