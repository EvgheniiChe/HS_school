<?php

namespace Database\Factories;

use App\Models\HomeworkSolution;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HomeworkSolutionMessage>
 */
class HomeworkSolutionMessageFactory extends Factory
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

    public function author(User $user): static
    {
        return $this->set('author_id', $user->id);
    }

    public function solution(HomeworkSolution $solution): static
    {
        return $this->set('solution_id', $solution->id);
    }

    public function message(string $message): static
    {
        return $this->set('message', $message);
    }
}
