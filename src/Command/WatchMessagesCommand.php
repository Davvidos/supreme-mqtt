<?php

namespace SupremeMqtt\Command;

use SupremeMqtt\Service\MqttClientService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WatchMessagesCommand extends Command
{
    protected static $defaultName = 'supreme-mqtt:watch-messages';

    private $mqttClientService;

    public function __construct(MqttClientService $mqttClientService)
    {
        parent::__construct();
        $this->mqttClientService = $mqttClientService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Run watcher to keep all new messages.')
            ->setHelp(
                'This command starts watcher that will print all new messages from MQTT channel.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Starting watching new messages from MQTT channel',
            '============',
            '',
        ]);

        $this->mqttClientService->connect();
        $this->mqttClientService->start();
    }
}
