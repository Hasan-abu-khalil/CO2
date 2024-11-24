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
        Schema::create('co2s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('percentage_id');
            $table->unsignedBigInteger('product_id');
            $table->string('unit');
            $table->decimal('amount', 5, 2);
            $table->timestamps();

            $table->foreign('percentage_id')->references('id')->on('percentages')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('co2s');
    }
};
