<?php

use function Pest\Laravel\patchJson;

it('updates course type data', function () {
    $courseType = courseType()
        ->title('Middle to Senior')
        ->create();

    patchJson(route('course-types.update', $courseType), [
        'title' => 'Senior to Lead',
    ]);

    expect($courseType->refresh())
        ->title->toBe('Senior to Lead');
});
