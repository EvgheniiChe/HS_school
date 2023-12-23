<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

it('creates new course type', function () {
    actingAs(user()->managerRole()->create())
        ->postJson(route('managers.course-types.store'), [
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

    actingAs(user()->managerRole()->create())
        ->postJson(route('managers.course-types.store'), [
            'title' => 'Middle to Senior',
        ])
            ->assertJsonValidationErrorFor('title');
});
