<?php

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

it('creates new course type', function () {
    postJson(route('admins.course-types.store'), [
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

    postJson(route('admins.course-types.store'), [
        'title' => 'Middle to Senior',
    ])
        ->assertJsonValidationErrorFor('title');
});
