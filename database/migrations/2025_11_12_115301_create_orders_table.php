<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable();
            $table->integer('priority')->nullable(); // 1 = nextday, 2 = sameday, 3 = express
            $table->string('delivery_address')->nullable();
            $table->string('status')->default('pending');
            $table->string('payment_method')->default('cash');
            $table->date('delivery_date')->nullable();
            $table->integer('total_price');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
