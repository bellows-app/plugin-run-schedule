<?php

use Bellows\Plugins\RunSchedule;

it('can create the run schedule job', function () {
    $result = $this->plugin(RunSchedule::class)->deploy();

    $jobs = $result->getJobs();

    expect($jobs)->toHaveCount(1);

    expect($jobs[0]->toArray())->toBe([
        'command'   => 'schedule:run',
        'frequency' => 'minutely',
        'user'      => null,
    ]);
});
