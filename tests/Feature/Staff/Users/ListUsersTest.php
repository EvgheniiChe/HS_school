<?php

use function Pest\Laravel\actingAs;

it('returns a list of users', function () {
    user()->adminRole()->create();
    user()->managerRole()->create();
    user()->studentRole()->create();
    user()->studentRole()->create();

    actingAs(user()->staffRole()->create())
        ->getJson(route('staff.users'))
        ->assertOk()
        ->assertJsonCount(5, 'data')
        ->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'name',
                    'email',
                    'telegram',
                    'role',
                ],
            ],
        ]);
});
