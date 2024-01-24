<?php

namespace FriendsOfOpenTelemetry\OpenTelemetryBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RemoveMailerInstrumentationPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (false === $container->getParameter('open_telemetry.instrumentation.mailer.tracing.enabled')) {
            $container->removeDefinition('open_telemetry.instrumentation.mailer.trace.event_subscriber');
            $container->removeDefinition('open_telemetry.instrumentation.mailer.trace.transports');
            $container->removeDefinition('open_telemetry.instrumentation.mailer.trace.default_transport');
            $container->removeDefinition('open_telemetry.instrumentation.mailer.trace.mailer');
        }

        if (false === $container->getParameter('open_telemetry.instrumentation.mailer.metering.enabled')) {
        }
    }
}