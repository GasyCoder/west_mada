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
        Schema::create('service_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->mediumText('resume');
            $table->text('contenus')->nullable();
            $table->string('images')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_pages');
    }
};
