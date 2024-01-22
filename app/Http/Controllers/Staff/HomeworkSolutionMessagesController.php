<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeworkSolutionMessageResource;
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

    public function post(HomeworkSolution $solution, Request $request): void
    {
        $this->validate($request, [
            'message' => ['required', 'string'],
        ]);

        HomeworkSolutionMessage::create([
            'solution_id' => $solution->id,
            'author_id' => auth()->user()->id,
            'message' => $request->message,
        ]);

        //@todo ивент студенту об ответе на домашку
    }
}
