<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\deleteJson;

it('can delete course type', function () {
    $courseType = courseType()->create();

    actingAs(user()->adminRole()->create())
        ->deleteJson(route('admins.course-types.delete', $courseType))
            ->assertOk();

    assertModelMissing($courseType);
});

it('cannot delete course type if there is a course uses this type', function () {
    course()
        ->type($courseType = courseType()->create())
        ->staff(user()->staffRole()->create())
        ->create();

    actingAs(user()->adminRole()->create())
        ->deleteJson(route('admins.course-types.delete', $courseType))
                ->assertUnprocessable();
});
