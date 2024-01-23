<?php

namespace App\Http\Actions\CourseStudent;

use App\Http\Enums\UserRole;
use App\Models\Course;
use App\Models\Group;
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

        Group::create([
            'course_id' => $course->id,
            'student_id' => $user->id,
        ]);
    }

    private function userAlreadyAttachedToTheCourse(User $user): bool
    {
        return Group::query()->where('student_id', $user->id)->exists();
    }

    private function userIsNotStudent(User $user): bool
    {
        return $user->role !== UserRole::STUDENT;
    }
}
