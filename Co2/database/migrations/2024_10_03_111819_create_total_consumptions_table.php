<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('total_consumptions', function (Blueprint $table) {
            $table->id();
            $table->decimal('q1');
            $table->decimal('q2');
            $table->decimal('q3');
            $table->decimal('q4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_consumptions');
    }
};
