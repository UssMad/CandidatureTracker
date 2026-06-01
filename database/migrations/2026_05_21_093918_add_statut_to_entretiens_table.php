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
        if (!Schema::hasColumn('entretiens', 'statut')) {
            Schema::table('entretiens', function (Blueprint $table) {
                $table->enum('statut', ['En attente', 'Refusé', 'accepté'])->after('date_heure');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('entretiens', 'statut')) {
            Schema::table('entretiens', function (Blueprint $table) {
                $table->dropColumn('statut');
            });
        }
    }
};
