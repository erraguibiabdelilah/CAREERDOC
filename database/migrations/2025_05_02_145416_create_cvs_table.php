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
        Schema::create('cvs', function (Blueprint $table) {
            $table->id('id_cv');
            $table->string('nom');
            $table->string('prenom');
            $table->integer('age');
            $table->string('adresse');
            $table->string('tele');
            $table->string('gmail');
            $table->string('lien_github')->nullable();
            $table->string('lien_linkedin')->nullable();
            $table->text('competences');
            $table->string('image')->nullable();
            $table->foreignId('id_personne')->constrained('personnes', 'id_personne');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
