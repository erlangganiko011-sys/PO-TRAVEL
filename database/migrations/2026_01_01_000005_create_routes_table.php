<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_terminal_id')->constrained('terminals');
            $table->foreignId('destination_terminal_id')->constrained('terminals');
            $table->decimal('distance', 10, 2)->nullable();
            $table->unsignedInteger('estimated_duration')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('routes'); }
};
