<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('creates new course type', function () {
    actingAs(user()->adminRole()->create())
        ->postJson(route('admins.course-types.store'), [
            'title' => 'Невероятный новый курс!',
        ]);

    assertDatabaseHas('course_types', [
        'title' => 'Невероятный новый курс!',
    ]);
});

it('wont create course if title is duplicate', function () {
    courseType()
        ->title('Middle to Senior')
        ->create();

    actingAs(user()->adminRole()->create())
        ->postJson(route('admins.course-types.store'), [
            'title' => 'Middle to Senior',
        ])
        ->assertJsonValidationErrorFor('title');
});
