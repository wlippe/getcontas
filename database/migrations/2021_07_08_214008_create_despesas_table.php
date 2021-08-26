<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('descricao', 50);
            $table->date('datavencimento');
            $table->float('valor');
            $table->smallInteger('tipo');
            $table->smallInteger('situacao')->nullable();
            $table->smallInteger('parcela')->nullable();
            $table->smallInteger('parcelastotal')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('despesas');

        $table->foreignId('user_id')->constrained()->onDelete('cascade');
    }
}
