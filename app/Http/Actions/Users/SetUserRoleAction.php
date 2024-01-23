<?php

namespace App\Http\Actions\Users;

use App\Models\User;

class SetUserRoleAction
{
    public function execute(User $user, string $role): void
    {
        $user->update([
            'role' => $role,
        ]);
    }
}
