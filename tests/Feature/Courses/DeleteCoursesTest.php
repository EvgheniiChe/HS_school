<?php

use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\deleteJson;

it('can delete course', function () {
    $course = course()
        ->type(courseType()->create())
        ->staff(user()->create())
        ->create();

    deleteJson(route('courses.delete', $course))
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

    deleteJson(route('courses.delete', $course))
        ->assertUnprocessable();
});
