<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Enums\SolutionStatus;
use App\Models\HomeworkSolution;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HomeworkSolutionStatusesController extends Controller
{
    public function __invoke(HomeworkSolution $solution, Request $request): void
    {
        $this->validate($request, [
            'status' => ['required', Rule::in(SolutionStatus::statuses)],
        ]);

        $solution->update([
            'status' => $request->status,
        ]);
    }
}
