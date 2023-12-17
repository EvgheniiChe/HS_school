<?php

namespace App\Http\Actions\Admins\Lessons;

use App\Http\Requests\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;

class StoreLessonAction
{
    public function execute(LessonRequest $request, Course $course): void
    {
        Lesson::create([
            'course_id' => $course->id,
            'theme' => $request->theme,
            'start_time' => $request->startTime,
            'info' => $request->info,
        ]);
    }
}
