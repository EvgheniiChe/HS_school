<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeworkSolutionMessageResource;
use App\Models\Homework;
use App\Models\HomeworkSolution;
use App\Models\HomeworkSolutionMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HomeworkSolutionMessagesController extends Controller
{
    public function index(HomeworkSolution $solution): AnonymousResourceCollection
    {
        return HomeworkSolutionMessageResource::collection(
            $solution->messages()->with(['author:id,name,email'])->orderBy('id')->get()
        );
    }

    public function post(Homework $homework, Request $request): void
    {
        $this->validate($request, [
            'message' => ['required', 'string'],
        ]);

        $solution = HomeworkSolution::query()
            ->firstOrCreate([
                'homework_id' => $homework->id,
                'student_id' => auth()->user()->id,
            ]);

        HomeworkSolutionMessage::create([
            'solution_id' => $solution->id,
            'author_id' => $solution->student_id,
            'message' => $request->message,
        ]);

        //@todo ивент учителю о новой домашке
    }

    //    #@todo мб стоит разделить создание "чата" с решением ДЗ и отправкой туда сообщений
    //    public function update(HomeworkSolutionMessage $message)
    //    {
    //
    //    }
}
