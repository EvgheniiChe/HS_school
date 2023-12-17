<?php

namespace App\Http\Actions\Admins\CourseStudent;

use App\Http\Enums\UserRole;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\User;

class AttachStudentToCourseAction
{
    public function execute(Course $course, User $user): void
    {
        abort_if(
            $this->userAlreadyAttachedToTheCourse($user),
            422,
            'This user already attached to the course'
        );

        abort_if(
            $this->userIsNotStudent($user),
            422,
            'This user is not a student'
        );

        CourseStudent::create([
            'course_id' => $course->id,
            'student_id' => $user->id,
        ]);
    }

    private function userAlreadyAttachedToTheCourse(User $user): bool
    {
        return CourseStudent::query()->where('student_id', $user->id)->exists();
    }

    private function userIsNotStudent(User $user): bool
    {
        return $user->role !== UserRole::STUDENT;
    }
}
