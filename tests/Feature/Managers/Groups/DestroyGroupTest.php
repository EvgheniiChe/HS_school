<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\deleteJson;

it('can delete CourseStudent entry', function () {
    $courseStudent = group()
        ->course($course = course()->withStaffAndType()->create())
        ->student($student = user()->studentRole()->create())
        ->create();

    actingAs(user()->managerRole()->create())
        ->deleteJson(route('managers.courses.student-group.delete', [$course, $student]))
            ->assertOk();

    assertModelMissing($courseStudent);
});
