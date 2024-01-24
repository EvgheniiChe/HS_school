<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeworkSolutionMessageResource;
use App\Models\Homework;
use App\Models\HomeworkSolution;
use App\Models\HomeworkSolutionMessage;
use App\Notifications\StaffHomeworkSolutionNotice;
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

        $student = auth()->user()->id;

        $solution = HomeworkSolution::query()
            ->where([
                'homework_id' => $homework->id,
                'student_id' => $student,
            ])->first();

        if (blank($solution)) {
            $solution = HomeworkSolution::create([
                'homework_id' => $homework->id,
                'student_id' => $student,
            ]);
        }

        $homeworkSolution = HomeworkSolutionMessage::create([
            'solution_id' => $solution->id,
            'author_id' => $solution->student_id,
            'message' => $request->message,
        ]);

        $homework->lesson->course->staff->notify(new StaffHomeworkSolutionNotice(
            $homeworkSolution, $student
        ));
    }
}
