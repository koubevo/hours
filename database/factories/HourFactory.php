<?php

namespace Database\Factories;

use App\Enum\HoursStatus;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hour>
 */
class HourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'employee_id' => Employee::factory()->create()->id,
            'work_date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'earning' => $this->faker->numberBetween(0, 1000),
            'description' => $this->faker->sentence(),
            'status' => HoursStatus::Completed->value,
        ];
    }
}
