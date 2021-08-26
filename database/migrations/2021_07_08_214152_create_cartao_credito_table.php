<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartaoCreditoTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cartaocredito', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('descricao', 50);
            $table->string('titular',   50)->nullable();
            $table->date('datavencimento');
            $table->smallInteger('bandeira');
            $table->smallInteger('digitos')->nullable();
            $table->float('limite')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()    {
        Schema::dropIfExists('cartaocredito');

        $table->foreignId('user_id')->constrained()->onDelete('cascade');
    }
}
