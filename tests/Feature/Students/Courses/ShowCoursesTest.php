<?php

use function Pest\Laravel\actingAs;

it('returns the course data', function () {
    $student = user()->studentRole()->create();

    $course = course()
        ->type(courseType()->create())
        ->staff(user()->create())
        ->create();

    group()->course($course)->student($student)->create();
    lesson()->course($course)->createMany(2);

    actingAs($student)
        ->getJson(route('students.courses.show', $course))
        ->assertOk()
        ->assertJson([
            'data' => [
                'courseType' => [
                    'title' => $course->type->title,
                ],
                'staff' => [
                    'name' => $course->staff->name,
                    'email' => $course->staff->email,
                ],
                'startDate' => $course->start_date,
                'endDate' => $course->end_date,
            ],
        ]);
});

it('returns error when student try to open foreign course', function () {
    $student = user()->studentRole()->create();

    $course = course()
        ->type(courseType()->create())
        ->staff(user()->create())
        ->create();

    group()->course($course)->student(user()->studentRole()->create())->create();

    actingAs($student)
        ->getJson(route('students.courses.show', $course))
        ->assertNotFound();
});
