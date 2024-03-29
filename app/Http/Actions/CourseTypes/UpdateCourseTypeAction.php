<?php

namespace App\Http\Actions\CourseTypes;

use App\Models\CourseType;

class UpdateCourseTypeAction
{
    public function execute(CourseType $type, string $title): void
    {
        $type->update([
            'title' => $title,
        ]);
    }
}
