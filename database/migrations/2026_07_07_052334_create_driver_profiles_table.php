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
    Schema::create('driver_profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        $table->enum('vehicle_type', ['motorcycle', 'car', 'bicycle', 'van'])->default('motorcycle');

        $table->boolean('is_available')->default(false);
        $table->decimal('current_lat', 10, 8)->nullable();
        $table->decimal('current_lng', 11, 8)->nullable();
        
        $table->decimal('wallet_balance', 10, 2)->default(0.00);
        $table->decimal('rating', 3, 2)->default(5.00);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_profiles');
    }
};
