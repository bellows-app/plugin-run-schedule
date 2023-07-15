<?php

namespace Bellows\Plugins;

use Bellows\PluginSdk\Contracts\Deployable;
use Bellows\PluginSdk\Data\JobParams;
use Bellows\PluginSdk\Enums\JobFrequency;
use Bellows\PluginSdk\Facades\Deployment;
use Bellows\PluginSdk\Plugin;
use Bellows\PluginSdk\PluginResults\CanBeDeployed;
use Bellows\PluginSdk\PluginResults\DeploymentResult;

class RunSchedule extends Plugin implements Deployable
{
    use CanBeDeployed;

    public function defaultForDeployConfirmation(): bool
    {
        return true;
    }

    public function deploy(): ?DeploymentResult
    {
        return DeploymentResult::create()->job(
            new JobParams(
                command: 'schedule:run',
                frequency: JobFrequency::MINUTELY,
            ),
        );
    }

    public function shouldDeploy(): bool
    {
        return !Deployment::server()->hasJob('schedule:run');
    }
}
