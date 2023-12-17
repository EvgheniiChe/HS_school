<?php

use function Pest\Laravel\getJson;

it('returns the course data', function () {
    $course = course()
        ->type(courseType()->create())
        ->staff(user()->create())
        ->create();

    getJson(route('staff.courses.show', $course))
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
            ]
        ]);
});
