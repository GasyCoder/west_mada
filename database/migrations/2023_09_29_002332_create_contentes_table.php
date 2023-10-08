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
        Schema::create('contentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('onglet_id');
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('liste')->nullable();
            $table->string('images')->nullable();
            $table->boolean('is_publish')->default(false);
            $table->timestamps();

            $table->foreign('onglet_id')->references('id')->on('onglets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contentes');
    }
};
