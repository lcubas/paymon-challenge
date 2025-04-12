<?php

namespace Database\Factories;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_id' => 1,
            'amount' => fake()->randomFloat(2, 100, 500),
            'method' => fake()->randomElement(PaymentMethod::values()),
            'status' => PaymentStatus::PAID,
            'paid_at' => now(),
        ];
    }
}
