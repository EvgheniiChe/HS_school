<?php

namespace App\Http\Actions\CourseTypes;

use App\Models\CourseType;

class StoreCourseTypeAction
{
    public function execute(string $title): bool
    {
        return CourseType::create([
            'title' => $title,
        ]);
    }
}
