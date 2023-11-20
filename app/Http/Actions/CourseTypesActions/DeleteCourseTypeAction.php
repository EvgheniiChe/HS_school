<?php

namespace App\Http\Actions\CourseTypesActions;

use App\Models\Course;
use App\Models\CourseType;

class DeleteCourseTypeAction
{
    public function execute(CourseType $courseType): void
    {
        abort_if(
            $this->cannotDeleteCourseType($courseType),
            422,
            'There are curses of this type'
        );

        $courseType->delete();
    }

    private function cannotDeleteCourseType(CourseType $type): bool
    {

        return Course::query()
            ->where('type_id', $type->id)
            ->exists();
    }
}
