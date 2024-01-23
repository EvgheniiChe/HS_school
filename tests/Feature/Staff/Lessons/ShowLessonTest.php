<?php

use Carbon\Carbon;

use function Pest\Laravel\actingAs;

it('returns lesson data', function () {
    $lesson = lesson()
        ->course(
            $course = course()
                ->withStaffAndType()
                ->create()
        )
        ->create();

    actingAs(user()->staffRole()->create())
        ->getJson(route('staff.lessons.show', [$course, $lesson]))
        ->assertOk()
        ->assertJson([
            'data' => [
                'id' => $lesson->id,
                'course' => [
                    'title' => $course->type->title,
                ],
                'theme' => $lesson->theme,
                'startTime' => Carbon::parse($lesson->start_time)->format('Y-m-d H:i:s'),
                'info' => $lesson->info,
            ],
        ]);
});
