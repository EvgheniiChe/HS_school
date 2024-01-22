<?php

use function Pest\Laravel\actingAs;

it('can update homework and return it', function () {
    $staff = user()->staffRole()->create();

    $course = course()
        ->staff($staff)
        ->type(courseType()->create())
        ->create();

    $homework = homework()
        ->lesson($lesson = lesson()->theme('Порождающие шаблоны проектирования')->course($course)->create())
        ->theme($lesson->theme)
        ->expiredAt(now()->addWeek())
        ->info('тест')
        ->create();

    actingAs($staff)
        ->patchJson(route('staff.homeworks.update', [$course, $lesson, $homework]), [
            'info' => 'Купить пиццу и написать пару строчек кода',
            'expirationDate' => now()->addWeeks(2),
        ])
        ->assertOk();

    expect($homework->refresh())
        ->theme->toBe('Порождающие шаблоны проектирования')
        ->info->toBe('Купить пиццу и написать пару строчек кода')
        ->expiration_date->toBe(now()->addWeeks(2)->format('Y-m-d'));
});

it('cannot set expirationDate less than current day', function () {
    $staff = user()->staffRole()->create();

    $course = course()
        ->staff($staff)
        ->type(courseType()->create())
        ->create();

    $homework = homework()
        ->lesson($lesson = lesson()->theme('Порождающие шаблоны проектирования')->course($course)->create())
        ->theme($lesson->theme)
        ->expiredAt(now()->addWeek())
        ->info('тест')
        ->create();

    actingAs($staff)
        ->patchJson(route('staff.homeworks.update', [$course, $lesson, $homework]), [
            'info' => $homework->info,
            'expirationDate' => now()->subDay(),
        ])
        ->assertJsonValidationErrors([
            'expirationDate' => [
                'The expiration date field must be a date after now.',
            ],
        ]);
});
