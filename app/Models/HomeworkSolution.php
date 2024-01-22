<?php

namespace App\Models;

use App\Http\Enums\SolutionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeworkSolution extends Model
{
    use HasFactory;

    protected $fillable = ['homework_id', 'student_id', 'status'];

    protected $casts = [
        'status' => SolutionStatus::class,
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(HomeworkSolutionMessage::class, 'solution_id');
    }
}
