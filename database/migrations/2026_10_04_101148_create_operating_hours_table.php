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
        Schema::create('operating_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')
                ->constrained('facilities')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // 0 means = Sunday
            // 1 means = Monday
            // 2 means = Tuesday
            // 3 means = Wednesday
            // 4 means = Thursday
            // 5 means = Friday
            // 6 means = Saturday
            $table->unsignedTinyInteger('day_of_week');

            $table->time('start_time');
            $table->time('end_time');

            $table->boolean('is_closed')->default(false);

            $table->unique(['facility_id','day_of_week']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operating_hours');
    }
};
