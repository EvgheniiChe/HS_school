<?php

namespace App\Http\Actions\Lessons;

use App\Models\Course;
use App\Models\Lesson;

class ShowLessonAction
{
    public function execute(Course $course, Lesson $lesson)
    {
        if ($lesson->course_id === $course->id) {
            return $lesson;
        }
    }
}
