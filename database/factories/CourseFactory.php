<?php

namespace Database\Factories;

use App\Models\CourseType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_id' => 1,
            'staff_id' => 1,
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addMonths(2)->format('Y-m-d'),
        ];
    }

    public function type(CourseType $type): static
    {
        return $this->set('type_id', $type->id);
    }

    public function staff(User $user): static
    {
        return $this->set('staff_id', $user->id);
    }

    public function startDate(string|Carbon $startDate): static
    {
        return $this->set('start_date', $startDate);
    }

    public function endDate(string|Carbon $endDate): static
    {
        return $this->set('end_date', $endDate);
    }

    public function withStaffAndType(): static
    {
        $data = [
            'type_id' => courseType()->create()->id,
            'staff_id' => user()->staffRole()->create()->id,
        ];

        return $this->state($data);
    }
}
