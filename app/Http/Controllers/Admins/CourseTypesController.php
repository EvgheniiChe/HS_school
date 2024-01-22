<?php

namespace App\Http\Controllers\Admins;

use App\Http\Actions\CourseTypes\DeleteCourseTypeAction;
use App\Http\Actions\CourseTypes\StoreCourseTypeAction;
use App\Http\Actions\CourseTypes\UpdateCourseTypeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseTypeRequest;
use App\Http\Resources\CourseTypeResource;
use App\Models\CourseType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseTypesController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CourseTypeResource::collection(
            CourseType::all()
        );
    }

    public function store(
        CourseTypeRequest $request,
        StoreCourseTypeAction $storeCourseType
    ): void {
        $storeCourseType->execute($request->input('title'));
    }

    public function show(CourseType $courseType): CourseTypeResource
    {
        return new CourseTypeResource($courseType);
    }

    public function update(
        CourseTypeRequest $request,
        CourseType $courseType,
        UpdateCourseTypeAction $updateCourseTypeAction
    ): void {
        $updateCourseTypeAction->execute($courseType, $request->input('title'));
    }

    public function destroy(CourseType $courseType, DeleteCourseTypeAction $deleteCourseType): void
    {
        $deleteCourseType->execute($courseType);
    }
}
