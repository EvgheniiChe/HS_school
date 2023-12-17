<?php

use function Pest\Laravel\getJson;

it('returns a list of users', function () {
    # Админ уже создан, от его лица выполняется запрос
    user()->managerRole()->create();
    user()->staffRole()->create();
    user()->studentRole()->create();
    user()->studentRole()->create();

    getJson(route('admins.users'))
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
