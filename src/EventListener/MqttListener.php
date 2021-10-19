<?php

namespace SupremeMqtt\EventListener;

use SupremeMqtt\Event\MessageReceivedEvent;

class MqttListener
{
    public function onMessageReceivedAction(MessageReceivedEvent $event): void
    {
        $message = $event->getMessage();

        var_dump($message);
    }
}
