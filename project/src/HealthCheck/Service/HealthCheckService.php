<?php

namespace App\HealthCheck\Service;

class HealthCheckService
{
    public function __construct(
        private string $payload
    ){}

    public function getPayload(): string
    {
        return $this->payload;
    }
}