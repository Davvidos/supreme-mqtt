<?php

namespace SupremeMqtt\Service;

use Mosquitto\Message;
use SupremeMqtt\Client\MqttClient;
use SupremeMqtt\Event\MessageReceivedEvent;
use SupremeMqtt\EventListener\MqttListener;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class MqttClientService
{
    private MqttClient $mqttClient;

    protected MqttListener $mqttListener;

    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        MqttClient $mqttClient,
        MqttListener $mqttListener,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->mqttClient = $mqttClient;
        $this->mqttListener = $mqttListener;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function connect(): void
    {
        $this->mqttClient->connectToBroker();
        $this->mqttClient->onConnect([$this, 'subscribeToTopics']);
        $this->mqttClient->onMessage([$this, 'messageEvent']);
    }

    public function subscribeToTopics(): void
    {
        $this->mqttClient->subscribe('#', 1);
    }

    public function messageEvent(Message $message): void
    {
        $event = new MessageReceivedEvent($message);
        $this->eventDispatcher->addListener(MessageReceivedEvent::EVENT_NAME, [$this->mqttListener, 'onMessageReceivedAction']);
        $this->eventDispatcher->dispatch($event, MessageReceivedEvent::EVENT_NAME);
    }

    public function start(): void
    {
        $this->mqttClient->loopForever();
    }
}
