<?php

namespace SupremeMqtt\EventListener;

use SupremeMqtt\Event\MessageReceivedEvent;

class MqttListener
{
    public function onMessageReceivedAction(MessageReceivedEvent $event): void
    {
        print_r($event->getMessage());
    }
}
