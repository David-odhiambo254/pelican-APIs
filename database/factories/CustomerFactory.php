<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $is_guest = $this->faker->boolean();
        $name = $is_guest ? 'Guest' : $this->faker->name();
        $email = $is_guest ? null : $this->faker->email();
        return [
            'name' => $name,
            'email' => $email,
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
            'is_guest' => $is_guest,
            'password' => null
        ];
    }
}
