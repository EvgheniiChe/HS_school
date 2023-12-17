<?php

namespace App\Http\Controllers\Admins;

use App\Http\Actions\Admins\Users\SetUserRoleAction;
use App\Http\Controllers\Controller;
use App\Http\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRolesController extends Controller
{
    public function __invoke(
        Request $request,
        User $user,
        SetUserRoleAction $setUserRole
    ): void
    {
        $request->validate([
            'role' => ['required', Rule::in(UserRole::roles)],
        ]);

        $setUserRole->execute($user, $request->input('role'));
    }
}
