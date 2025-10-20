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
        if (!Schema::hasTable('bookings')) {
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->foreignId('flight_id')->constrained('flights')->cascadeOnDelete();
                $table->integer('seats')->default(1);
                $table->decimal('total_price', 10, 2)->default(0);
                $table->string('status')->default('pending');
                $table->string('booking_code')->nullable()->unique();
                $table->string('passenger_name')->nullable();
                $table->string('passenger_email')->nullable();
                $table->string('passenger_phone')->nullable();
                $table->string('passenger_id_number')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
