<?php

use function Pest\Laravel\getJson;

it('returns a list of student which are attached to this course', function () {
    $course = course()
        ->withStaffAndType()
        ->create();

    user()
        ->studentRole()
        ->createMany(3)
        ->each(fn($student) => courseStudent()->course($course)->student($student)->create());

    getJson(route('managers.courses.students.index', $course))
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'name',
                    'email',
                    'telegram',
                    'role',
                ]
            ]
        ]);
});
