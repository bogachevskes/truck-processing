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
        $data = $message->getMessage();
        
        echo 'Выполнена разгрузка грузовика: ' . $data['item']->id . '<br>';
        echo 'Доставлен груз ' . $data['item']->type->value . ' в объеме ' . $data['item']->capacity  . ' кг.<br>';
        echo '<br>';
    }
}