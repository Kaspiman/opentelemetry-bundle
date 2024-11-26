<?php

namespace FriendsOfOpenTelemetry\OpenTelemetryBundle\Resources;

use OpenTelemetry\SDK\Common\Attribute\Attributes;
use OpenTelemetry\SDK\Resource\ResourceDetectorInterface;
use OpenTelemetry\SDK\Resource\ResourceInfo;
use OpenTelemetry\SemConv\ResourceAttributes;

final readonly class BundleResourceDetector implements ResourceDetectorInterface
{
    public function __construct(private array $config)
    {
    }

    public function getResource(): ResourceInfo
    {
        $attributes = [
            ResourceAttributes::SERVICE_NAMESPACE => $this->config['namespace'],
            ResourceAttributes::SERVICE_NAME => $this->config['name'],
            ResourceAttributes::SERVICE_VERSION => $this->config['version'],
            ResourceAttributes::DEPLOYMENT_ENVIRONMENT_NAME => $this->config['environment'],
        ];

        return ResourceInfo::create(Attributes::create($attributes), ResourceAttributes::SCHEMA_URL);
    }
}
