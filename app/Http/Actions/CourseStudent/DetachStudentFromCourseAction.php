<?php

namespace App\Http\Actions\CourseStudent;

use App\Models\Course;
use App\Models\Group;
use App\Models\User;

class DetachStudentFromCourseAction
{
    public function execute(Course $course, User $user): void
    {
        Group::query()
            ->where('course_id', $course->id)
            ->where('student_id', $user->id)
            ->delete();
    }
}
