<?php

use Illuminate\Support\Facades\Date;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;
use function Pest\Laravel\travelTo;

it('returns 1 a list of courses', function () {
    travelTo(Date::parse('2023-11-21'));

    $student = user()->studentRole()->create();

    $course = course()
        ->withStaffAndType()
        ->startDate('2023-10-21')
        ->endDate(now()->addMonth()->format('Y-m-d'))
        ->create();
//        ->createMany(3)
//        ->map(function ($course) {
//            lesson()
//                ->course($course)
//                ->createMany(2);
//        });

    group()->course($course)->student($student)->create();
    lesson()->course($course)->createMany(2);

    actingAs($student)
        ->getJson(route('students.courses.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'courseType' => [
                        'title'
                    ],
                    'staff' => [
                        'name',
                        'email',
                    ],
                    'lessons' => [
                        [
                            'id',
                            'theme',
                            'startTime',
                            'info',
                        ]
                    ],
                    'startDate',
                    'endDate',
                ]
            ]);
});
