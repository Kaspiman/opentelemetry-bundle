<?php

namespace FriendsOfOpenTelemetry\OpenTelemetryBundle\Instrumentation\Twig;

use OpenTelemetry\API\Trace\SpanInterface;
use OpenTelemetry\API\Trace\SpanKind;
use OpenTelemetry\API\Trace\TracerInterface;
use OpenTelemetry\Context\Context;
use Twig\Extension\AbstractExtension;
use Twig\Profiler\NodeVisitor\ProfilerNodeVisitor;
use Twig\Profiler\Profile;

class TraceableTwigExtension extends AbstractExtension
{
    /**
     * @var \SplObjectStorage<Profile, SpanInterface>
     */
    private \SplObjectStorage $spans;

    public function __construct(
        private readonly TracerInterface $tracer,
    ) {
        $this->spans = new \SplObjectStorage();
    }

    public function enter(Profile $profile): void
    {
        $scope = Context::storage()->scope();
        if (null === $scope) {
            return;
        }

        $spanBuilder = $this->tracer
            ->spanBuilder($this->getSpanName($profile))
            ->setSpanKind(SpanKind::KIND_SERVER)
        ;

        $parent = Context::getCurrent();

        $span = $spanBuilder->setParent($parent)->startSpan();

        $this->spans[$profile] = $span;
    }

    public function leave(Profile $profile): void
    {
        $scope = Context::storage()->scope();
        if (null === $scope) {
            return;
        }

        if (!isset($this->spans[$profile])) {
            return;
        }
        $this->spans[$profile]->end();
        unset($this->spans[$profile]);
    }

    public function getNodeVisitors(): array
    {
        return [
            new ProfilerNodeVisitor(self::class),
        ];
    }

    private function getSpanName(Profile $profile): string
    {
        switch (true) {
            case $profile->isRoot():
                return $profile->getName();

            case $profile->isTemplate():
                return $profile->getTemplate();

            default:
                return sprintf('%s::%s(%s)', $profile->getTemplate(), $profile->getType(), $profile->getName());
        }
    }
}