<?php

namespace App\Http\Actions\Homework;

use App\Models\Group;
use App\Models\Homework;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetAllHomeworkForStudentAction
{
    public function execute(User $user): Collection
    {
        return Homework::query()
            ->whereBelongsTo(Group::query()
                ->where('student_id', $user->id)
                ->first()
                ->course
                ->lessons)
            ->get();
    }
}
