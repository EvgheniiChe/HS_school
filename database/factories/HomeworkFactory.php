<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Homework>
 */
class HomeworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'theme' => 'Шаблоны работы с базами данных',
            'expiration_date' => now()->addWeek(),
        ];
    }

    public function lesson(Lesson $lesson): static
    {
        return $this->set('lesson_id', $lesson->id);
    }

    public function theme(string $theme): static
    {
        return $this->set('theme', $theme);
    }

    public function info(string $info): static
    {
        return $this->set('info', $info);
    }

    public function expiredAt(string $expirationDate): static
    {
        return $this->set('expiration_date', $expirationDate);
    }
}
