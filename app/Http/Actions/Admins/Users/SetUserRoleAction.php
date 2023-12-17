<?php

namespace App\Http\Actions\Admins\Users;

use App\Models\User;

class SetUserRoleAction
{
    public function execute(User $user, string $role): void
    {
        $user->update([
            'role' => $role
        ]);
    }
}
