<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertModelMissing;

it('can delete CourseStudent entry', function () {
    $courseStudent = group()
        ->course($course = course()->withStaffAndType()->create())
        ->student($student = user()->studentRole()->create())
        ->create();

    actingAs(user()->adminRole()->create())
        ->deleteJson(route('admins.courses.student-group.delete', [$course, $student]))
        ->assertOk();

    assertModelMissing($courseStudent);
});
