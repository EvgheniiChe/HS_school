<?php

use Illuminate\Support\Facades\Date;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\travelTo;

it('returns a list of courses', function () {
    travelTo(Date::parse('2023-11-21'));

    course()
        ->withStaffAndType()
        ->startDate('2023-10-21')
        ->endDate(now()->addMonth()->format('Y-m-d'))
        ->createMany(3)
        ->map(function ($course) {
            lesson()
                ->course($course)
                ->createMany(2);
        });

    actingAs(user()->managerRole()->create())
        ->getJson(route('managers.courses.index'))
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'courseType' => [
                        'title',
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
                        ],
                    ],
                    'startDate',
                    'endDate',
                ],
            ],
        ]);
});
