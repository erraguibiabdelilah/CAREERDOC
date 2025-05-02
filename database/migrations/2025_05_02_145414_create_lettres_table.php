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
        Schema::create('lettres', function (Blueprint $table) {
            $table->id('id_lettre');
            $table->date('date');
            $table->string('emetteur');
            $table->string('destinateur');
            $table->string('objet');
            $table->text('contenu');
            $table->string('adresse_emetteur');
            $table->foreignId('id_personne')->constrained('personnes', 'id_personne');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lettres');
    }
};
