<?php

namespace GaelReyrol\OpenTelemetryBundle\Factory\TracerProvider;

use OpenTelemetry\SDK\Trace\SamplerInterface;
use OpenTelemetry\SDK\Trace\SpanProcessorInterface;
use OpenTelemetry\SDK\Trace\TracerProviderInterface;

interface TracerProviderFactoryInterface
{
    /**
     * @param SpanProcessorInterface[] $processors
     */
    public static function create(SamplerInterface $sampler, array $processors): TracerProviderInterface;
}
