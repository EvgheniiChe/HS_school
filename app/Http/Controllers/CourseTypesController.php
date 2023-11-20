<?php

namespace App\Http\Controllers;

use App\Http\Actions\CourseTypesActions\DeleteCourseTypeAction;
use App\Http\Actions\CourseTypesActions\StoreCourseTypeAction;
use App\Http\Actions\CourseTypesActions\UpdateCourseTypeAction;
use App\Http\Requests\CourseTypeRequest;
use App\Http\Resources\CourseTypeResource;
use App\Models\CourseType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

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
