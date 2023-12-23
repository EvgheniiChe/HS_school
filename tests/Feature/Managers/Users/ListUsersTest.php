<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('returns a list of users', function () {
    user()->adminRole()->create();
    user()->staffRole()->create();
    user()->studentRole()->create();
    user()->studentRole()->create();

    actingAs(user()->managerRole()->create())
        ->getJson(route('managers.users'))
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
                    ]
                ]
            ]);
});
