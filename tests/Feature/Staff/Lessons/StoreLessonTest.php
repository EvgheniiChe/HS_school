<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

it('creates new lesson', function () {
    actingAs(user()->staffRole()->create())
        ->postJson(route(
            'staff.lessons.store',
            $course = course()->withStaffAndType()->create()
        ),
            [
                'theme' => 'Порождающие шаблоны проектирования',
                'startTime' => '2023-11-20 19:00:00',
                'info' => 'Важная информация',
            ]
        )
        ->assertOk();

    assertDatabaseHas('lessons', [
        'course_id' => $course->id,
        'theme' => 'Порождающие шаблоны проектирования',
        'start_time' => '2023-11-20 19:00:00',
        'info' => 'Важная информация',
    ]);
});
