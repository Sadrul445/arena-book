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
        Schema::create('pricing_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')
                ->constrained('facilities')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('name', 100);

            $table->time('start_time');
            $table->time('end_time');

            $table->unsignedInteger('priority')->default(0);

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_periods');
    }
};
