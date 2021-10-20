<?php

namespace SupremeMqtt\Client;

use Mosquitto\Client;

class MqttClient extends Client
{
    public function __construct(
        protected string $user,
        protected string $password,
        protected ?string $host,
        protected ?int $port,
        protected ?int $keepAliveInterval
    ) {
        parent::__construct('pid_' . getmypid());
        $this->setCredentials($user, $password);
    }

    public function connectToBroker(): int
    {
        return $this->connect($this->host, $this->port, $this->keepAliveInterval);
    }
}
