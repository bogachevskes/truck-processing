<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveOutputCollection implements ObserverInterface
{
    public function observe(Message $message): void
    {
        ob_start();
    }
}