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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('period_id');
            $table->enum('type', ['entree', 'sortie']);
            $table->integer('quantity');
            $table->string('by_date');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('reference')->nullable();
            $table->timestamps();

            // Clé étrangère vers la table "stocks et category_stocks"
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('category_stocks')->onDelete('cascade');
            $table->foreign('period_id')->references('id')->on('periodes')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
