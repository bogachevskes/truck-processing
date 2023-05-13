<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveConsoleProcessTruckStart implements ObserverInterface
{
    public function observe(Message $message): void
    {
        echo "\033[0;33mПопытка разгрузки грузовика: " . $message->message['item']->id . PHP_EOL;
        echo 'Груз ' . $message->message['item']->type->value . ' в объеме ' . $message->message['item']->capacity  . " кг.\033[0m" . PHP_EOL;
    }
}