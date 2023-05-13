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
        echo "\033[0;31mОшибка при разгрузке грузовика ID: " . $message->message['item']->id . "\033[0m" . PHP_EOL;
        echo "\033[0;31mПричина: " . $message->message['error']->getMessage() . "\033[0m" . PHP_EOL;
        echo PHP_EOL;
    }
}