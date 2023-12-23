<?php

namespace App\Http\Controllers\Students;

use App\Http\Actions\Homework\GetAllHomeworkForStudentAction;
use App\Http\Actions\Homework\StudentCannotShowHomeworkAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeworkResource;
use App\Models\Group;
use App\Models\Homework;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HomeworksController extends Controller
{
//    public function index(GetAllHomeworkForStudentAction $getAllHomeworkForStudent): AnonymousResourceCollection
//    {
//        return HomeworkResource::collection(
//            $getAllHomeworkForStudent->execute(auth()->user())
//        );
//    }

    public function show(Homework $homework, StudentCannotShowHomeworkAction $userCannotShowHomework): HomeworkResource
    {
        abort_if($userCannotShowHomework->execute(auth()->user(), $homework), 404);

        return new HomeworkResource($homework);
    }
}
