<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
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
