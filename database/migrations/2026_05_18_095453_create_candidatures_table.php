<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('entreprise');
            $table->string('poste');
            $table->string('url_offre')->nullable();
            $table->enum('statut', ['envoyée', 'en_cours', 'entretien', 'offre', 'refusée', 'abandonnée'])->default('envoyée');
            $table->enum('priorite', ['faible', 'moyenne', 'haute'])->default('moyenne');
            $table->text('notes')->nullable();
            $table->date('date_candidature');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
