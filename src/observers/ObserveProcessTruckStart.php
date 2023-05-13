<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveProcessTruckStart implements ObserverInterface
{
    public function observe(Message $message): void
    {
        echo 'Попытка разгрузки грузовика: ' . $message->message['item']->id . '<br>';
        echo 'Груз ' . $message->message['item']->type->value . ' в объеме ' . $message->message['item']->capacity  . ' кг.<br>';
    }
}