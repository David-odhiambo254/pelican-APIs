<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\File;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Create the necessary orders
        // $orders = Order::factory()->count(10)->create();

        // // Assign files to each order
        // $files = File::factory()->count(15)->create();

        // foreach ($orders as $order) {
        //     $order->files()->attach(
        //         $files->random(rand(1, 5))->pluck('id')->toArray()
        //     );
        // }

        Customer::factory()
            ->count(10)
            ->has(
                Order::factory()
                    ->count(10)
                    ->has(
                        File::factory()
                            ->count(10)
                    ))
            ->create();

    }
}
