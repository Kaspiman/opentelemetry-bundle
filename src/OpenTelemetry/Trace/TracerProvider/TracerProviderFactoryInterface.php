<?php

namespace FriendsOfOpenTelemetry\OpenTelemetryBundle\OpenTelemetry\Trace\TracerProvider;

use OpenTelemetry\SDK\Resource\ResourceInfo;
use OpenTelemetry\SDK\Trace\SamplerInterface;
use OpenTelemetry\SDK\Trace\SpanProcessorInterface;
use OpenTelemetry\SDK\Trace\TracerProviderInterface;

interface TracerProviderFactoryInterface
{
    /**
     * @param SpanProcessorInterface[] $processors
     */
    public function createProvider(?SamplerInterface $sampler = null, array $processors = [], ?ResourceInfo $info = null): TracerProviderInterface;
}
