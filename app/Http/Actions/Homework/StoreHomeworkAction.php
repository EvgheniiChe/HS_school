<?php

namespace App\Http\Actions\Homework;

use App\Http\Requests\HomeworkRequest;
use App\Models\Homework;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;

class StoreHomeworkAction
{
    public function execute(HomeworkRequest $request, Lesson $lesson): Model
    {
        return Homework::query()
            ->create([
                'lesson_id' => $lesson->id,
                'theme' => $lesson->theme,
                'info' => $request->info,
                'expiration_date' => $request->expirationDate,
            ]);
    }
}
