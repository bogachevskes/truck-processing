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
        $data = $message->getMessage();
        
        echo 'Ошибка при разгрузке грузовика ID: ' . $data['item']->id . '<br>';
        echo 'Причина: ' . $data['error']->getMessage() . '<br>';
        echo '<br>';
    }
}