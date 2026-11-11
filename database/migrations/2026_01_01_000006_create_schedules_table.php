<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained('buses');
            $table->foreignId('route_id')->constrained('routes');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->decimal('price', 12, 2);
            $table->enum('status', ['available', 'full', 'cancelled'])->default('available');
            $table->timestamps();
            $table->index(['departure_time', 'status']);
        });
    }
    public function down(): void { Schema::dropIfExists('schedules'); }
};
