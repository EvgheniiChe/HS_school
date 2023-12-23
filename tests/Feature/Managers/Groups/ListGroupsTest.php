<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('returns a list of student which are attached to this course', function () {
    $course = course()
        ->withStaffAndType()
        ->create();

    user()
        ->studentRole()
        ->createMany(3)
        ->each(fn($student) => group()->course($course)->student($student)->create());

    actingAs(user()->managerRole()->create())
        ->getJson(route('managers.courses.student-group.index', $course))
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
