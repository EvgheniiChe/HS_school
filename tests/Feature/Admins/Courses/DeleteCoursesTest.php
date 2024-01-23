<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertModelMissing;

it('can delete course', function () {
    $course = course()
        ->type(courseType()->create())
        ->staff(user()->create())
        ->create();

    actingAs(user()->adminRole()->create())
        ->deleteJson(route('admins.courses.delete', $course))
        ->assertOk();

    assertModelMissing($course);
});

it('cannot delete course if there is a lesson of this course', function () {
    $course = course()
        ->type(courseType()->create())
        ->staff(user()->create())
        ->create();

    lesson()
        ->course($course)
        ->create();

    actingAs(user()->adminRole()->create())
        ->deleteJson(route('admins.courses.delete', $course))
        ->assertUnprocessable();
});
