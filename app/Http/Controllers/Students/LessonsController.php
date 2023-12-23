<?php

namespace App\Http\Controllers\Students;

use App\Http\Actions\Lessons\ShowLessonAction;
use App\Http\Actions\Lessons\StoreLessonAction;
use App\Http\Actions\Lessons\UpdateLessonAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Http\Resources\LessonResource;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LessonsController extends Controller
{
    public function index(Course $course): AnonymousResourceCollection
    {
        # @todo студент может видеть только свои уроки
        return LessonResource::collection(
            Lesson::query()
                ->where('course_id', $course->id)
                ->get()
        );
    }

    public function show(
        Course $course,
        Lesson $lesson,
        ShowLessonAction $showLesson
    ): LessonResource
    {
        return new LessonResource(
            $showLesson->execute($course, $lesson)
        );
    }
}
