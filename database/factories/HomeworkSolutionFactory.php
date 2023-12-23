<?php

namespace Database\Factories;

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
            'message' => fake()->sentence(4),
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

    public function staff(User $user): static
    {
        return $this->set('staff_id', $user->id);
    }

    public function message(string $message): static
    {
        return $this->set('message', $message);
    }
}
