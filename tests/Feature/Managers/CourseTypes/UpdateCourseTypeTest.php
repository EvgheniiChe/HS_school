<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\patchJson;

it('updates course type data', function () {
    $courseType = courseType()
        ->title('Middle to Senior')
        ->create();

    actingAs(user()->managerRole()->create())
        ->patchJson(route('managers.course-types.update', $courseType), [
            'title' => 'Senior to Lead',
        ]);

    expect($courseType->refresh())
        ->title->toBe('Senior to Lead');
});
