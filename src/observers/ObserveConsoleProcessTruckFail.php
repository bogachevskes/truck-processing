<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveConsoleProcessTruckFail implements ObserverInterface
{
    public function observe(Message $message): void
    {
        $data = $message->getMessage();
        
        echo "\033[0;31mОшибка при разгрузке грузовика ID: " . $data['item']->id . "\033[0m" . PHP_EOL;
        echo "\033[0;31mПричина: " . $data['error']->getMessage() . "\033[0m" . PHP_EOL;
        echo PHP_EOL;
    }
}