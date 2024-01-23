<?php

use function Pest\Laravel\actingAs;

it('returns a list of course types', function () {
    courseType()
        ->createMany([
            ['title' => 'Hard & Soft Skills'],
            ['title' => 'Middle to Senior'],
            ['title' => 'Tech Lead'],
        ]);

    actingAs(user()->managerRole()->create())
        ->getJson(route('managers.course-types.index'))
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'title',
                ],
            ],
        ]);
});
