<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->bigInteger('aplicacao_id')->constrained()->nullable();
            $table->bigInteger('receita_id')->constrained()->nullable();
            $table->bigInteger('conta_id')->constrained()->nullable();
            $table->smallInteger('tipo')->nullable();
            $table->smallInteger('lancamento');
            $table->date('data');
            $table->float('valor');
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
        Schema::dropIfExists('extratos');
    }
}
