<?php

namespace app;

use app\components\{
    EventDispatcher,
    Message,
};

use app\strategies\StrategyInterface;

class SlotsLoadHandler
{
    private $modes = [];

    public function __construct(private EventDispatcher $eventDispatcher) { }
    
    public function addMode(StrategyInterface $mode): void
    {
        $this->modes[$mode->getProductType()->name] = $mode;
    }
    
    public function removeMode(StrategyInterface $mode): void
    {
        if (isset($this->modes[$mode->getProductType()->name]) === false) {
            return;
        }
        
        unset($this->modes[$mode->getProductType()->name]);
    }
    
    private function beforeGateway(DTO $context): void
    {
        $this->eventDispatcher->trigger(Event::GATEWAY_START, new Message([
            'item' => $context,
        ]));
    }

    private function processGateway(Truck $item): void
    {
        try {

            $this->eventDispatcher->trigger(Event::PROCESS_TRUCK_START, new Message([
                'item' => $item,
            ]));

            if (isset($this->modes[$item->type->name]) === false) {
                throw new \LogicException('Сырье ' . $item->type->value . ' не может быть разгружено. Слот разгрузки отсутствует');
            }

            $this->modes[$item->type->name]->unload($item);

            $this->eventDispatcher->trigger(Event::PROCESS_TRUCK_DONE, new Message([
                'item' => $item,
            ]));

        } catch (\LogicException $e) {
            $this->eventDispatcher->trigger(Event::PROCESS_TRUCK_FAIL, new Message([
                'item' => $item,
                'error' => $e,
            ]));
        }
    }

    private function afterGateway(DTO $context): void
    {
        $this->eventDispatcher->trigger(Event::GATEWAY_DONE, new Message([
            'item' => $context,
        ]));
    }
    
    public function handle(DTO $context): void
    {
        $this->beforeGateway($context);

        foreach ($context->trucks as $truck) {
            $this->processGateway($truck);
        }

        $this->afterGateway($context);
    }
}