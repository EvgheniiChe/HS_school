<?php

use function Pest\Laravel\actingAs;

it('returns a list of users', function () {
    user()->managerRole()->create();
    user()->staffRole()->create();
    user()->studentRole()->create();
    user()->studentRole()->create();

    actingAs(user()->adminRole()->create())
        ->getJson(route('admins.users'))
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
