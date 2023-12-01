<?php

namespace FriendsOfOpenTelemetry\OpenTelemetryBundle\OpenTelemetry\Log\LoggerProvider;

use OpenTelemetry\API\Logs\LoggerProviderInterface;
use OpenTelemetry\SDK\Logs\LogRecordProcessorInterface;

interface LoggerProviderFactoryInterface
{
    public static function create(LogRecordProcessorInterface $processor): LoggerProviderInterface;
}
