<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroTrabalhoCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_trabalho_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card_id');
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim')->nullable();
            $table->string('descricao', 255)->nullable();
            $table->timestamps();

            $table->foreign('card_id')->references('id')->on('cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_trabalho_cards');
    }
}
