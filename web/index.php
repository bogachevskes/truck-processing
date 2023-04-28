<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use app\{
    DTO,
    Event,
    ProductTypes,
    Warehouse,
    SlotsLoadHandler,
    Slot,
    TrucksFactory,
};

use app\strategies\{
    CheesePowderUnloadStrategy,
    SpicesUnloadStrategy,
    TropicalOilsUnloadStrategy,
};

use app\observers\{
    ObserveGatewayEnd,
    ObserveGatewayStart,
    ObserveProcessTruckDone,
    ObserveProcessTruckFail,
    ObserveProcessTruckStart,
};

use app\components\EventDispatcher;

Warehouse::loadSlotsOnce([
    new Slot(ProductTypes::TYPE_TROPICAL_OILS, rand(25, 2500)),
    new Slot(ProductTypes::TYPE_SPICES, rand(25, 2500)),
    new Slot(ProductTypes::TYPE_CHEESE_POWDER, rand(25, 2500)),
]);

$eventDispatcher = new EventDispatcher;

$eventDispatcher->attach(Event::GATEWAY_START, new ObserveGatewayStart);
$eventDispatcher->attach(Event::GATEWAY_DONE, new ObserveGatewayEnd);
$eventDispatcher->attach(Event::PROCESS_TRUCK_START, new ObserveProcessTruckStart);
$eventDispatcher->attach(Event::PROCESS_TRUCK_DONE, new ObserveProcessTruckDone);
$eventDispatcher->attach(Event::PROCESS_TRUCK_FAIL, new ObserveProcessTruckFail);

$model = new DTO;

$model->trucks = (new TrucksFactory(ProductTypes::cases()))->createTrucks(rand(9, 15));

$handler = new SlotsLoadHandler($eventDispatcher);

$handler->addMode(new CheesePowderUnloadStrategy);
$handler->addMode(new SpicesUnloadStrategy);
$handler->addMode(new TropicalOilsUnloadStrategy);

$handler->handle($model);