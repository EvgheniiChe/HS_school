<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\deleteJson;

it('can delete a lesson', function () {
    $lesson = lesson()
        ->course(
            $course = course()
                ->withStaffAndType()
                ->create()
        )
        ->create();

    actingAs(user()->staffRole()->create())->
        deleteJson(route('staff.lessons.destroy', [$course, $lesson]) )
            ->assertOk();

    assertModelMissing($lesson);
});
