<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('returns a list of course types', function () {
    courseType()
        ->createMany([
            ['title' => 'Hard & Soft Skills'],
            ['title' => 'Middle to Senior'],
            ['title' => 'Tech Lead'],
        ]);

    actingAs(user()->adminRole()->create())
        ->getJson(route('admins.course-types.index'))
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'title',
                    ]
                ]
            ]);
});
