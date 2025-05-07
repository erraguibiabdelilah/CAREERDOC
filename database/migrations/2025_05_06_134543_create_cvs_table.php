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
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->integer('age');
            $table->string('adresse');
            $table->string('tel');
            $table->text('profile');
            $table->string('gmail');
            $table->string('lienGithub')->nullable();
            $table->string('lienLinkedin')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('id_user')->constrained('users', 'id');
            $table->foreignId('id_template')->constrained('users', 'id');
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
