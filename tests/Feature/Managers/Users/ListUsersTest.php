<?php

use function Pest\Laravel\getJson;

it('returns a list of users', function () {
    # Менеджер уже создан, от его лица выполняется запрос
    user()->adminRole()->create();
    user()->staffRole()->create();
    user()->studentRole()->create();
    user()->studentRole()->create();

    getJson(route('managers.users'))
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
