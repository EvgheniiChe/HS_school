<?php

namespace App\Http\Controllers\Students;

use App\Http\Actions\Admins\Courses\DeleteCourseAction;
use App\Http\Actions\Admins\Courses\StoreCourseAction;
use App\Http\Actions\Admins\Courses\UpdateCourseAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CoursesController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CourseResource::collection(
            Course::with(['type', 'lessons'])
                ->get()
        );
    }

    public function show(Course $course): CourseResource
    {
        return new CourseResource($course->load(['type', 'staff', 'lessons']));
    }
}
