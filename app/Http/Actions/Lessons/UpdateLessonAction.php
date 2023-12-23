<?php

namespace App\Http\Actions\Lessons;

use App\Http\Requests\LessonRequest;
use App\Models\Lesson;

class UpdateLessonAction
{
    public function execute(LessonRequest $request, Lesson $lesson)
    {
        $lesson->update([
            'theme' => $request->theme,
            'start_time' => $request->startTime,
            'info' => $request->info,
        ]);
    }
}
