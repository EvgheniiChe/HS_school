<?php

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

    deleteJson(route('admins.lessons.destroy', [$course, $lesson]) )
        ->assertOk();

    assertModelMissing($lesson);
});
