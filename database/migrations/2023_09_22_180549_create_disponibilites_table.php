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
        Schema::create('disponibilites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->date('date_debut');
            $table->date('date_fin');   
            $table->boolean('disponible')->default(true);
            $table->timestamps();

            $table->unique(['hotel_id', 'date_debut', 'date_fin']);
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disponibilites');
    }
};
