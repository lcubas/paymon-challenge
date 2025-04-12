<?php

namespace Database\Factories;

use App\Enums\EnrollmentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
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
            'status' => fake()->randomElement(EnrollmentStatus::values()),
            'enrolled_at' => now(),
        ];
    }
}
