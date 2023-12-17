<?php

use function Pest\Laravel\getJson;

it('returns course type data', function () {
    $courseType = courseType()->create();

    getJson(route('managers.course-types.show', $courseType))
        ->assertOk()
        ->assertJson([
            'data' => [
                'id' => $courseType->id,
                'title' => $courseType->title,
            ]
        ]);
});
