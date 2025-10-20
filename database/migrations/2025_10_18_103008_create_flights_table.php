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
        if (!Schema::hasTable('flights')) {
            Schema::create('flights', function (Blueprint $table) {
                $table->id();
                $table->string('flight_number')->unique();
                $table->foreignId('departure_airport_id')->constrained('airports')->cascadeOnDelete();
                $table->foreignId('arrival_airport_id')->constrained('airports')->cascadeOnDelete();
                $table->dateTime('departure_time');
                $table->dateTime('arrival_time');
                $table->decimal('price', 10, 2)->default(0);
                $table->integer('available_seats')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
