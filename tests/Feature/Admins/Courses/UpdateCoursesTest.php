<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\patchJson;

it('update the course', function () {
    $course = course()
        ->type(courseType()->create())
        ->staff(user()->create())
        ->startDate('2023-10-21')
        ->endDate(now()->addMonth()->format('Y-m-d'))
        ->create();

    actingAs(user()->adminRole()->create())
        ->patchJson(route('admins.courses.update', $course), [
            'typeID' => $course->type_id,
            'staffID' => $newUserID = user()->create()->id,
            'startDate' => '2023-10-24',
            'endDate' => $course->end_date,
        ])->assertOk();

    expect($course->refresh())
        ->staff_id->toBe($newUserID)
        ->start_date->toBe('2023-10-24');
});
