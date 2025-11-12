<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'file_path' => $this->faker->imageUrl(),
            'file_name' => $this->faker->word(),
            'print_size' => $this->faker->randomElement(['A0', 'A1', 'A2', 'A3', 'A4', 'A5']),
            'color_mode' => $this->faker->randomElement(['color', 'black-white']),
            'copies' => $this->faker->randomNumber(1),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
        ];
    }
}
