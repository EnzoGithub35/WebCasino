<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShifumiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifumi', function (Blueprint $table) {
            $table->id('Id');
            $table->integer('NbVictoire');
            $table->integer('NbDefaite');
            $table->integer('RatioVictoire');
            $table->string('HeureDebutPartie', 45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifumi');
    }
}