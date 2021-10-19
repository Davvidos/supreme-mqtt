<?php

namespace SupremeMqtt\Event;

use Mosquitto\Message;
use Symfony\Contracts\EventDispatcher\Event;

class MessageReceivedEvent extends Event
{
    public const EVENT_NAME = 'mqtt.message.received.action';

    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }
    public function getMessage(): Message
    {
        return $this->message;
    }
}
