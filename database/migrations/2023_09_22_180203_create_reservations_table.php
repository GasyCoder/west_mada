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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ref');
            $table->string('client_name');
            $table->string('sexe');
            $table->unsignedBigInteger('hotel_id');
            $table->date('date_debut');
            $table->time('checkin'); // Add check-in time
            $table->date('date_fin');
            $table->time('checkout'); // Add check-out time
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(false);
            $table->enum('statut', ['confirmée', 'en_attente', 'annulé', 'terminé', 'supprimé', 'remboursé'])->default('en_attente');
            $table->boolean('deleted')->default(false);
            $table->integer('pourcent');
            $table->decimal('montant', 10, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
        });

    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
