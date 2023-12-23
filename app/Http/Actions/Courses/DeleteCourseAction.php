<?php

namespace App\Http\Actions\Courses;

use App\Models\Course;

class DeleteCourseAction
{
    public function execute(Course $course): void
    {
        abort_if(
            $this->cannotDeleteCourse($course),
            422,
            'There is a group of this course'
        );

        $course->delete();
    }

    private function cannotDeleteCourse(Course $course): bool
    {
        return filled($course->lessons);
    }
}
