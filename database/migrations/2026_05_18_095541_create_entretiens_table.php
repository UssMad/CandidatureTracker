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
        Schema::create('entretiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['téléphonique', 'visio', 'présentiel', 'technique', 'RH']);
            $table->dateTime('date_heure');
            $table->enum('statut', ['En attente','Refusé','accepté']);
            $table->text('notes_preparation')->nullable();
            $table->enum('resultat', ['en_attente', 'positif', 'négatif'])->default('en_attente');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entretiens');
    }
};
