<?php

namespace App\Http\Actions\Homework;

use App\Models\Group;
use App\Models\Homework;
use App\Models\User;

class StudentCannotShowHomeworkAction
{
    public function execute(User $user, Homework $homework): bool
    {
        return Group::query()
            ->where('student_id', $user->id)
            ->where('course_id', $homework->lesson->course->id)
            ->doesntExist();
    }
}
