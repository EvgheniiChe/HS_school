<?php

namespace App\Http\Controllers\Staff;

use App\Http\Actions\Homework\StoreHomeworkAction;
use App\Http\Actions\Homework\UpdateHomeworkDataAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\HomeworkRequest;
use App\Http\Resources\HomeworkResource;
use App\Models\Course;
use App\Models\Homework;
use App\Models\Lesson;

class HomeworksController extends Controller
{
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
