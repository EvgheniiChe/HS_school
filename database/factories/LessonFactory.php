<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'theme' => fake()->word,
            'info' => fake()->sentence,
            'start_time' => now()->format('Y-m-d H:i:s'),
        ];
    }

    public function course(Course $course): self
    {
        return $this->set('course_id', $course->id);
    }
}
