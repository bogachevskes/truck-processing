<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveProcessTruckFail implements ObserverInterface
{
    public function observe(Message $message): void
    {
        echo 'Ошибка при разгрузке грузовика ID: ' . $message->message['item']->id . '<br>';
        echo 'Причина: ' . $message->message['error']->getMessage() . '<br>';
        echo '<br>';
    }
}