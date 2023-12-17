<?php

namespace App\Http\Actions\Admins\Lessons;

use App\Models\Course;
use App\Models\Lesson;

class ShowLessonAction
{
    public function execute(Course $course, Lesson $lesson): Lesson
    {
        abort_if($lesson->course_id !== $course->id, 404);

        return $lesson;
    }
}
