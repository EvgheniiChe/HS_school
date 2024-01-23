<?php

namespace App\Http\Controllers\Students;

use App\Http\Actions\Courses\StudentCannotShowCourseAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Group;

class CoursesController extends Controller
{
    public function index(): CourseResource
    {
        // @todo мб уроки подгружать не нужно

        return new CourseResource(
            Group::query()
                ->where('student_id', auth()->user()->id)
                ->first()
                ->course
                ->load('lessons')
        );
    }

    public function show(Course $course, StudentCannotShowCourseAction $userCannotShowCourse): CourseResource
    {
        abort_if($userCannotShowCourse->execute(auth()->user(), $course), 404);

        return new CourseResource($course->load(['type', 'staff', 'lessons']));
    }
}
