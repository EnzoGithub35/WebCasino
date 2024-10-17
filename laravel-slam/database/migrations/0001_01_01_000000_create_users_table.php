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
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->id('IdUtilisateur');
            $table->string('pseudo', 99)->unique();
            $table->string('Nom', 45);
            $table->string('Prenom', 45);
            $table->string('email', 45)->unique();
            $table->string('mdp', 999)->nullable();
            $table->timestamp('DateCreationCompte')->nullable();
            $table->string('AdresseIP', 45)->nullable();
            $table->integer('coins');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('utilisateur');
    }
};
