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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reference');
            $table->string('name')->unique();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('service_id');
            $table->integer('stock_quantity');
            $table->integer('price_u');
            $table->integer('min_quantity')->default(0);
            $table->string('unite_stock')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->uuid('uuid')->unique();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category_stocks')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
