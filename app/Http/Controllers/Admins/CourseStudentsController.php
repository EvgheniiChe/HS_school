<?php

namespace App\Http\Controllers\Admins;

use App\Http\Actions\Admins\CourseStudent\AttachStudentToCourseAction;
use App\Http\Actions\Admins\CourseStudent\DetachStudentFromCourseAction;
use App\Http\Controllers\Controller;
use App\Http\Enums\UserRole;
use App\Http\Resources\UserResource;
use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseStudentsController extends Controller
{
    public function index(Course $course): AnonymousResourceCollection
    {
        # Список студентов курса
        return UserResource::collection(
            User::query()
                ->with([
                    'course' => fn(Builder $builder) => $builder->where('course_id', $course->id)
                ])
                ->where('role', UserRole::STUDENT)
                ->get()
        );
    }

    public function store(
        Course $course,
        User $student,
        AttachStudentToCourseAction $attachStudentToCourse,
    ): void
    {
        $attachStudentToCourse->execute($course, $student);
    }

    public function destroy(
        Course $course,
        User $student,
        DetachStudentFromCourseAction $detachStudentFromCourse
    ): void
    {
        $detachStudentFromCourse->execute($course, $student);
    }
}
