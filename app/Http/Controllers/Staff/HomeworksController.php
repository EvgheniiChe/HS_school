<?php

namespace App\Http\Controllers\Staff;

use App\Http\Actions\Homework\StoreHomeworkAction;
use App\Http\Actions\Homework\UpdateHomeworkDataAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\HomeworkRequest;
use App\Http\Resources\HomeworkResource;
use App\Models\Course;
use App\Models\Group;
use App\Models\Homework;
use App\Models\Lesson;
use Illuminate\Contracts\Database\Eloquent\Builder;

class HomeworksController extends Controller
{
    //    public function index(Course $course)
    //    {
    //        Course::query()
    //            ->join('course_types as t', 't.id', 'courses.type_id')
    //            ->join('lessons as l', 'l.course_id', 'courses.id')
    //            ->join('homeworks as h', 'h.lesson_id', 'l.id')
    //            ->get([
    //                'courses.id as course_id', 't.title', 'h.id as homework_id', 'l.id as lesson_id',
    //                'h.theme', 'h.info', 'h.expiration_date'
    //            ])->dd();
    //
    //        dd(Course::query()
    //            ->with(['type', 'lessons.homework'])
    //            ->where('id', $course->id)
    //            ->get()
    ////            ->mapWithKeys(function (Course $course) {
    ////                return [$course->id => $course->lessons->map(function (Lesson $lesson) {
    ////                    return $lesson->homework;
    ////                })];
    ////            })
    //->toArray());
    //
    //        return Homework::query()
    //            ->whereIn('lesson_id', [
    //                Group::query()
    //                    ->with([
    //                        'course' => fn(Builder $query) => $query->where('staff_id', auth()->user()->id),
    //                        'course.lessons'
    //                    ])
    //            ])
    //            ->get();
    //    }

    public function store(
        HomeworkRequest $request,
        Course $course,
        Lesson $lesson,
        StoreHomeworkAction $storeHomework,
    ): HomeworkResource {
        return new HomeworkResource(
            $storeHomework->execute($request, $lesson)
        );
    }

    public function show(
        Course $course,
        Lesson $lesson,
        Homework $homework
    ): HomeworkResource {
        return new HomeworkResource($homework);
    }

    public function update(
        HomeworkRequest $request,
        Course $course,
        Lesson $lesson,
        Homework $homework,
        UpdateHomeworkDataAction $updateHomeworkData
    ): HomeworkResource {
        return new HomeworkResource(
            $updateHomeworkData->execute($request, $homework)
        );
    }

    public function destroy(
        Course $course,
        Lesson $lesson,
        Homework $homework,
    ): void {
        // @todo проверка перед удалением
        $homework->delete();
    }
}
