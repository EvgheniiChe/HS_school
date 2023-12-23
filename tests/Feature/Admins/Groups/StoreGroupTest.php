<?php


use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

it('can attach user to course', function () {
    $course = course()->withStaffAndType()->create();
    $student = user()->studentRole()->create();

    actingAs(user()->adminRole()->create())
        ->postJson(route('admins.courses.student-group.store', [$course, $student]))
            ->assertOk();

    assertDatabaseHas('groups', [
        'course_id' => $course->id,
        'student_id' => $student->id,
    ]);
});

it('cannot attach user to second course', function () {
    $course = course()->withStaffAndType()->create();
    $student = user()->studentRole()->create();

    group()->course($course)->student($student)->create();

    actingAs(user()->adminRole()->create())
        ->postJson(route('admins.courses.student-group.store', [$course, $student]))
            ->assertUnprocessable()
            ->assertJsonPath('message', 'This user already attached to the course');
});

it('cannot attach user with wrong role', function () {
    $course = course()->withStaffAndType()->create();
    $student = user()->managerRole()->create();

    actingAs(user()->adminRole()->create())
        ->postJson(route('admins.courses.student-group.store', [$course, $student]))
            ->assertUnprocessable()
            ->assertJsonPath('message', 'This user is not a student');
});
