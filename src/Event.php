<?php

namespace app;

enum Event
{
    case GATEWAY_START;
    
    case GATEWAY_DONE;

    case PROCESS_TRUCK_START;

    case PROCESS_TRUCK_DONE;

    case PROCESS_TRUCK_FAIL;
}