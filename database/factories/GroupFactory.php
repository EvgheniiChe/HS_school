<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => 1,
            'course_id' => 1,
        ];
    }

    public function course(int $courseID): self
    {
        return $this->set('course_id', $courseID);
    }

    public function student(int $studentID): self
    {
        return $this->set('student_id', $studentID);
    }
}
