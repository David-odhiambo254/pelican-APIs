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
        Schema::create('image_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id'); // Assuming you want to link this to a customer
            $table->string('image_path'); // Store the path to the uploaded image
            $table->text('generated_description'); // Store the AI generated description from API
            $table->string('original_filename');
            $table->integer('file_size');
            $table->string('mime_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_descriptions');
    }
};
