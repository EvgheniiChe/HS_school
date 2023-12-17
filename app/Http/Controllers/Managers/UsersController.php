<?php

namespace App\Http\Controllers\Managers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UsersController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::query()
                ->orderBy('role')
                ->get()
        );
    }
}
