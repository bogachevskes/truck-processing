<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveProcessTruckDone implements ObserverInterface
{
    public function observe(Message $message): void
    {
        echo 'Выполнена разгрузка грузовика: ' . $message->message['item']->id . '<br>';
        echo 'Доставлен груз ' . $message->message['item']->type->value . ' в объеме ' . $message->message['item']->capacity  . ' кг.<br>';
        echo '<br>';
    }
}