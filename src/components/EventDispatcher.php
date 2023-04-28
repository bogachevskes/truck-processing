<?php

namespace app\components;

use app\Event;

class EventDispatcher
{
    private array $eventObservers = [];
    
    public function attach(Event $event, ObserverInterface $observer): void
    {
        $this->eventObservers[$event->name] = $observer;
    }

    public function detach(Event $event): void
    {
        if (isset($this->eventObservers[$event->name]) === false) {
            return;
        }
        
        unset($this->eventObservers[$event->name]);
    }

    public function trigger(Event $event, Message $message): void
    {
        if (isset($this->eventObservers[$event->name]) === false) {
            return;
        }

        $this->eventObservers[$event->name]->observe($message);
    }
}