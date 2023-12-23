<?php

use Illuminate\Support\Facades\Date;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;
use function Pest\Laravel\travelTo;

it('returns the course data', function () {
    $course = course()
        ->type(courseType()->create())
        ->staff(user()->create())
        ->create();

    actingAs(user()->adminRole()->create())
        ->getJson(route('admins.courses.show', $course))
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
