<?php

namespace FriendsOfOpenTelemetry\OpenTelemetryBundle\OpenTelemetry\Trace\SpanProcessor;

use OpenTelemetry\SDK\Trace\SpanExporterInterface;
use OpenTelemetry\SDK\Trace\SpanProcessor\SimpleSpanProcessor;
use OpenTelemetry\SDK\Trace\SpanProcessorInterface;

final class SimpleSpanProcessorFactory implements SpanProcessorFactoryInterface
{
    public static function create(
        array $processors = null,
        SpanExporterInterface $exporter = null
    ): SpanProcessorInterface {
        if (null === $exporter) {
            throw new \InvalidArgumentException('Exporter is null');
        }

        return new SimpleSpanProcessor($exporter);
    }
}
