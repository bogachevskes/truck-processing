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
        echo "\033[0;32mВыполнена разгрузка грузовика: " . $message->message['item']->id . PHP_EOL;
        echo 'Доставлен груз ' . $message->message['item']->type->value . ' в объеме ' . $message->message['item']->capacity  . " кг.\033[0m" . PHP_EOL;
        echo PHP_EOL;
    }
}