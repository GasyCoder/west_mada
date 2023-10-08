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
        Schema::create('pages_type', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['apropos_de_nous', 'politique_de_confidentialite', 'mentions_legale', 'conditions_des_services', 'autres'])->default('apropos_de_nous');
            $table->string('slug');
            $table->mediumText('sub_title');
            $table->text('contenus')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages_type');
    }
};
