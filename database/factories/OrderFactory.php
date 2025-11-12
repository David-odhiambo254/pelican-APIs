<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'priority' => $this->faker->randomElement([1, 2, 3]),
            'delivery_address' => $this->faker->address(),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'payment_method' => $this->faker->randomElement(['mpesa', 'visa', 'mastercard']),
            'delivery_date' => $this->faker->dateTime(),
            'total_price' => $this->faker->randomNumber(5),
            'note' => $this->faker->sentence(),
        ];
    }
}
