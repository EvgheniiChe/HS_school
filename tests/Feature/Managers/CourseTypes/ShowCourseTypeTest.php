<?php

use function Pest\Laravel\actingAs;

it('returns course type data', function () {
    $courseType = courseType()->create();

    actingAs(user()->managerRole()->create())
        ->getJson(route('managers.course-types.show', $courseType))
        ->assertOk()
        ->assertJson([
            'data' => [
                'id' => $courseType->id,
                'title' => $courseType->title,
            ],
        ]);
});
