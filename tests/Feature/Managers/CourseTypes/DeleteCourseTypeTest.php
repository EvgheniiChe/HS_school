<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertModelMissing;

it('can delete course type', function () {
    $courseType = courseType()->create();

    actingAs(user()->managerRole()->create())
        ->deleteJson(route('managers.course-types.delete', $courseType))
        ->assertOk();

    assertModelMissing($courseType);
});

it('cannot delete course type if there is a course uses this type', function () {
    course()
        ->type($courseType = courseType()->create())
        ->staff(user()->staffRole()->create())
        ->create();

    actingAs(user()->managerRole()->create())
        ->deleteJson(route('managers.course-types.delete', $courseType))
        ->assertUnprocessable();
});
