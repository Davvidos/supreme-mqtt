<?php

namespace SupremeMqtt\Event;

use Mosquitto\Message;
use Symfony\Contracts\EventDispatcher\Event;

class MessageReceivedEvent extends Event
{
    public const EVENT_NAME = 'mqtt.message.received.action';

    public function __construct(private Message $message) {}

    public function getMessage(): Message
    {
        return $this->message;
    }
}
