<?php

use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\deleteJson;

it('can delete course type', function () {
    $courseType = courseType()->create();

    deleteJson(route('course-types.delete', $courseType))
        ->assertOk();

    assertModelMissing($courseType);
});

it('cannot delete course type if there is a course uses this type', function () {

})->skip('Написать');
