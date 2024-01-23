<?php

use function Pest\Laravel\actingAs;

it('returns a list of lessons based by course', function () {
    $course = course()
        ->withStaffAndType()
        ->create();

    lesson()
        ->course($course)
        ->createMany(3);

    actingAs(user()->managerRole()->create())
        ->getJson(route('managers.lessons.index', $course))
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'course' => ['title'],
                    'theme',
                    'startTime',
                    'info',
                ],
            ],
        ]);
});

it('returns only lessons belong to course', function () {
    $course = course()
        ->withStaffAndType()
        ->create();

    $courseWithoutLessons = course()
        ->withStaffAndType()
        ->create();

    lesson()
        ->course($course)
        ->createMany(3);

    actingAs(user()->managerRole()->create())
        ->getJson(route('managers.lessons.index', $courseWithoutLessons))
        ->assertOk()
        ->assertJsonCount(0, 'data');
});
