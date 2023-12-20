<?php

namespace FriendsOfOpenTelemetry\OpenTelemetryBundle\OpenTelemetry\Trace\SpanExporter;

use FriendsOfOpenTelemetry\OpenTelemetryBundle\OpenTelemetry\OtlpExporterCompressionEnum;
use FriendsOfOpenTelemetry\OpenTelemetryBundle\OpenTelemetry\OtlpExporterFormatEnum;
use OpenTelemetry\SDK\Trace\SpanExporterInterface;

interface SpanExporterFactoryInterface
{
    /**
     * @param array<string, string> $headers
     */
    public static function create(
        string $endpoint = null,
        array $headers = null,
        OtlpExporterFormatEnum $format = null,
        OtlpExporterCompressionEnum $compression = null,
    ): SpanExporterInterface;
}