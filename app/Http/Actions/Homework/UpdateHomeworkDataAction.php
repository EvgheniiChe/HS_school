<?php

namespace App\Http\Actions\Homework;

use App\Http\Requests\HomeworkRequest;
use App\Models\Homework;

class UpdateHomeworkDataAction
{
    public function execute(HomeworkRequest $request, Homework $homework): mixed
    {
        return tap($homework, fn ($homework) => $homework->update([
            'info' => $request->info,
            'expiration_date' => $request->expirationDate,
        ]));
    }
}
