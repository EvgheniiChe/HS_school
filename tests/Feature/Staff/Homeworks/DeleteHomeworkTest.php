<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertModelMissing;

it('can delete homework', function () {
    $staff = user()->staffRole()->create();

    $course = course()
        ->staff($staff)
        ->type(courseType()->create())
        ->create();

    $homework = homework()
        ->lesson($lesson = lesson()->theme('Порождающие шаблоны проектирования')->course($course)->create())
        ->theme($lesson->theme)
        ->expiredAt(now()->addWeek())
        ->info('Лучшее домашнее задание ever')
        ->create();

    actingAs($staff)
        ->deleteJson(route('staff.homeworks.show', [$course, $lesson, $homework]))
        ->assertOk();

    assertModelMissing($homework);
});
