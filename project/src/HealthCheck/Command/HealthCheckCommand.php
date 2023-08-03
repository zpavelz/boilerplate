<?php

namespace App\HealthCheck\Command;

use App\HealthCheck\Service\HealthCheckService;
use Symfony\Component\Console\{Command\Command, Input\InputInterface, Output\OutputInterface, Style\SymfonyStyle};

class HealthCheckCommand extends Command
{
    protected static $defaultName = 'health-check:run';
    protected HealthCheckService $service;

    public function __construct(HealthCheckService $service, string $name = null)
    {
        parent::__construct($name);
        $this->service = $service;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $i = new SymfonyStyle($input, $output);
        $i->title('Health check');

        try {
            $i->success($this->service->getPayload());
        } catch (\Throwable $exception) {
            $i->error($exception->getMessage());
            $i->error($exception->getTraceAsString());
        }

        return 0;
    }
}