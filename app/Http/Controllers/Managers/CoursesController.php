<?php

namespace App\Http\Controllers\Managers;

use App\Http\Actions\Courses\DeleteCourseAction;
use App\Http\Actions\Courses\StoreCourseAction;
use App\Http\Actions\Courses\UpdateCourseAction;
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

    public function store(
        CourseStoreRequest $request,
        StoreCourseAction $storeCourse
    ): void {
        $storeCourse->execute($request);
    }

    public function show(Course $course): CourseResource
    {
        return new CourseResource($course->load(['type', 'staff', 'lessons']));
    }

    public function update(
        CourseUpdateRequest $request,
        Course $course,
        UpdateCourseAction $updateCourseAction
    ): void {
        $updateCourseAction->execute($course, $request);
    }

    public function destroy(Course $course, DeleteCourseAction $deleteCourse): void
    {
        $deleteCourse->execute($course);
    }
}
