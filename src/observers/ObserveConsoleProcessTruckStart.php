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
        $data = $message->getMessage();
        
        echo "\033[0;33mПопытка разгрузки грузовика: " . $data['item']->id . PHP_EOL;
        echo 'Груз ' . $data['item']->type->value . ' в объеме ' . $data['item']->capacity  . " кг.\033[0m" . PHP_EOL;
    }
}