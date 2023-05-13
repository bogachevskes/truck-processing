<?php

namespace app\components;

class Message
{
    public function __construct(public readonly mixed $message) { }
}