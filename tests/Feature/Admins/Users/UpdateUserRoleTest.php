<?php

use App\Http\Enums\UserRole;
use function Pest\Laravel\patchJson;

it('can change user role from student to staff', function () {
    $student = user()
        ->studentRole()
        ->create();

    patchJson(route('admins.users.role', $student), [
        'role' => UserRole::STAFF
    ])
        ->assertOk();

    expect($student->refresh())
        ->role->toBe(UserRole::STAFF);
});
