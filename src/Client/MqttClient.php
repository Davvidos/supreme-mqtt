<?php

namespace SupremeMqtt\Client;

use Mosquitto\Client;

class MqttClient extends Client
{
    protected string $user;

    protected string $password;

    protected ?string $host;

    protected ?int $port;

    protected ?int $keepAliveInterval;

    public function __construct(string $user= null,  string $password = null, ?string $host= null, ?int $port = null, ?int $keepAliveInterval = null) {
        parent::__construct('pid_' . getmypid());
        $this->setCredentials($user, $password);
        $this->host = $host;
        $this->port = $port;
        $this->keepAliveInterval = $keepAliveInterval;
    }

    public function connectToBroker(): int
    {
        return $this->connect($this->host, $this->port, $this->keepAliveInterval);
    }
}
