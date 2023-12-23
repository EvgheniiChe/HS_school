<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('returns course type data', function () {
    $courseType = courseType()->create();

    actingAs(user()->adminRole()->create())
        ->getJson(route('admins.course-types.show', $courseType))
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $courseType->id,
                    'title' => $courseType->title,
                ]
            ]);
});
