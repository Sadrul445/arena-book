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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_category_id')->constrained('service_categories')->onDelete('cascade');
            $table->string('name', 150);
            $table->string('slug', 180)->unique();
            $table->text('description')->nullable();

            $table->string('location', 150)->nullable();

            // booking = entire facility/unit is booked
            // person = booking based on number of persons
            $table->string('capacity_type', 30)
                ->default('booking');

            $table->unsignedInteger('capacity')
                ->default(1);

            // fixed = Football / Cricket
            // per_person = Swimming / Kids Zone / Water Activities
            $table->string('pricing_type', 30)
                ->default('fixed');

            $table->boolean('status')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
