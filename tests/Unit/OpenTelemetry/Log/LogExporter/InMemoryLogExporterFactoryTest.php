<?php

namespace FriendsOfOpenTelemetry\OpenTelemetryBundle\Tests\Unit\OpenTelemetry\Log\LogExporter;

use FriendsOfOpenTelemetry\OpenTelemetryBundle\OpenTelemetry\Exporter\EmptyExporterOptions;
use FriendsOfOpenTelemetry\OpenTelemetryBundle\OpenTelemetry\Exporter\ExporterDsn;
use FriendsOfOpenTelemetry\OpenTelemetryBundle\OpenTelemetry\Exporter\ExporterOptionsInterface;
use FriendsOfOpenTelemetry\OpenTelemetryBundle\OpenTelemetry\Log\LogExporter\InMemoryLogExporterFactory;
use FriendsOfOpenTelemetry\OpenTelemetryBundle\OpenTelemetry\Transport\TransportFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(InMemoryLogExporterFactory::class)]
class InMemoryLogExporterFactoryTest extends TestCase
{
    #[DataProvider('exporterProvider')]
    public function testCreateExporter(string $dsn, ExporterOptionsInterface $options, bool $supports): void
    {
        $dsn = ExporterDsn::fromString($dsn);
        $exporterFactory = new InMemoryLogExporterFactory(new TransportFactory([]));

        self::assertEquals($supports, $exporterFactory->supports($dsn, $options));
        if (false === $supports) {
            return;
        }

        $exporterFactory->createExporter($dsn, $options);
    }

    /**
     * @return \Generator<string, array{
     *     string,
     *     ExporterOptionsInterface,
     *     bool,
     * }>
     */
    public static function exporterProvider(): \Generator
    {
        yield 'in-memory' => [
            'in-memory://default',
            new EmptyExporterOptions(),
            true,
        ];

        yield 'unsupported' => [
            'foo://default',
            new EmptyExporterOptions(),
            false,
        ];
    }
}
