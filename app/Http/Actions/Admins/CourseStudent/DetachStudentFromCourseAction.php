<?php

namespace App\Http\Actions\Admins\CourseStudent;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\User;

class DetachStudentFromCourseAction
{
    public function execute(Course $course, User $user): void
    {
        CourseStudent::query()
            ->where('course_id', $course->id)
            ->where('student_id', $user->id)
            ->delete();
    }
}
