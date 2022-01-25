<?php

use App\HealthCheck\Service\HealthCheckService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HealthCheckTest extends KernelTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    public function testHealthyEnv()
    {
        $this->assertSame(
            'healthy-test',
            static::getContainer()
                ->get(HealthCheckService::class)
                ->getPayload()
        );
    }

    public function testHealthyDirectly()
    {
        $expectedString = 'healthy-directly';
        $this->assertSame(
            $expectedString,
            (new HealthCheckService($expectedString))
                ->getPayload()
        );
    }

    public function testHealthyMock()
    {
        $expectedString = 'healthy-mock';
        $service = $this->createMock(HealthCheckService::class);
        $service->expects($this->once())
            ->method('getPayload')
            ->willReturn($expectedString)
        ;
        $this->assertSame($expectedString, $service->getPayload());
    }
}