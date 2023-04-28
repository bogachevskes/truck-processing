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
        $data = $message->getMessage();
        
        echo 'Попытка разгрузки грузовика: ' . $data['item']->id . '<br>';
        echo 'Груз ' . $data['item']->type->value . ' в объеме ' . $data['item']->capacity  . ' кг.<br>';
    }
}