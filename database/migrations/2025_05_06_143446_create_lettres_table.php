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
            $table->id();
            $table->string('lieuEtDate');
            $table->string('nomEmetteur');
            $table->string('email');
            $table->string('tel');
            $table->string('adresseEmetteur');
            $table->string('entrepriseName');
            $table->string('adresseEntreprise');
            $table->string('objet');
            $table->text('contenu');
            $table->string('signature');
            $table->foreignId('id_user')->constrained('users', 'id');
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
