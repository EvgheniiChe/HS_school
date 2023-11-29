<?php

use Illuminate\Support\Facades\Date;
use function Pest\Laravel\getJson;
use function Pest\Laravel\travelTo;

it('returns a list of courses', function () {
    travelTo(Date::parse('2023-11-21'));

    course()
        ->type(courseType()->create())
        ->staff(user()->create())
        ->startDate('2023-10-21')
        ->endDate(now()->addMonth()->format('Y-m-d'))
        ->createMany(3);

    getJson(route('courses.index'))
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                [
                    'courseType' => [
                        'title'
                    ],
                    'startDate',
                    'endDate',
                ]
            ]
        ]);
});
