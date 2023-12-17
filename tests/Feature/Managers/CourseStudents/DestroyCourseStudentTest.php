<?php

use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\deleteJson;

it('can delete CourseStudent entry', function () {
    $courseStudent = courseStudent()
        ->course($course = course()->withStaffAndType()->create())
        ->student($student = user()->studentRole()->create())
        ->create();

    deleteJson(route('managers.courses.students.delete', [$course, $student]))
        ->assertOk();

    assertModelMissing($courseStudent);
});
