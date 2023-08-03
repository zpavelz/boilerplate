<?php

use App\HealthCheck\Service\HealthCheckService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Tester\CommandTester;

class HealthCheckTest extends KernelTestCase
{
    protected KernelInterface $app;

    public function setUp(): void
    {
        parent::setUp();
        $this->app = self::bootKernel();
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

    public function testHealthyCli()
    {
        $application = new ConsoleApplication($this->app);
        $command = $application->find('health-check:run');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $commandTester->assertCommandIsSuccessful();
        $this->assertStringContainsString(
            static::getContainer()
                ->get(HealthCheckService::class)
                ->getPayload(),
            $commandTester->getDisplay()
        );
    }
}