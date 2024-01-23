<?php

namespace Database\Factories;

use App\Http\Enums\SolutionStatus;
use App\Models\Homework;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HomeworkSolution>
 */
class HomeworkSolutionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'homework_id' => 1,
        ];
    }

    public function homework(Homework $homework): static
    {
        return $this->set('homework_id', $homework);
    }

    public function student(User $user): static
    {
        return $this->set('student_id', $user->id);
    }

    public function opened(): static
    {
        return $this->set('status', SolutionStatus::OPENED);
    }

    public function closed(): static
    {
        return $this->set('status', SolutionStatus::CLOSED);
    }
}
