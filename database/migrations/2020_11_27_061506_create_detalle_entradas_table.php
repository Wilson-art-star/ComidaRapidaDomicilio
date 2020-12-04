<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_entradas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_entrada')->unsigned();
            $table->integer('id_insumo')->unsigned();
            $table->integer('cantidad');

            $table->foreign('id_entrada')->references('id')->on('entrada_invemtario_insumos');
            $table->foreign('id_insumo')->references('id')->on('insumos');
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
        Schema::dropIfExists('detalle_entradas');
    }
}
