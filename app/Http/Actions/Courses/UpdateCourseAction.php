<?php

namespace App\Http\Actions\Courses;

use App\Http\Requests\CourseUpdateRequest;
use App\Models\Course;

class UpdateCourseAction
{
    public function execute(Course $course, CourseUpdateRequest $request): void
    {
        $course->fill([
            'type_id' => $request->typeID,
            'staff_id' => $request->staffID,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
        ])->save();
    }
}
