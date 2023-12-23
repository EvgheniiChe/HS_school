<?php

namespace App\Http\Actions\Courses;

use App\Models\Course;
use App\Models\Group;
use App\Models\User;

class StudentCannotShowCourseAction
{
    public function execute(User $user, Course $course): bool
    {
        return Group::query()
            ->where('course_id', $course->id)
            ->where('student_id', $user->id)
            ->doesntExist();
    }
}
