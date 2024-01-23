<?php

namespace App\Http\Actions\Courses;

use App\Http\Requests\CourseStoreRequest;
use App\Models\Course;

class StoreCourseAction
{
    public function execute(CourseStoreRequest $request): void
    {
        Course::create([
            'type_id' => $request->typeID,
            'staff_id' => $request->staffID,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
        ]);
    }
}
