<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveOutputCollected implements ObserverInterface
{
    public function observe(Message $message): void
    {
        $output = ob_get_contents();

        ob_end_clean();

        $file = PROJECT_ROOT . 'runtime/log-' . time() .'.html';

        file_put_contents($file, $output);

        echo $output;
    }
}