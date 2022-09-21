<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogLiquidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_liquidations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('liquidation_id')->unsigned();
            $table->foreign('liquidation_id')->references('id')->on('liquidations')->onUpdate('cascade')->onDelete('cascade');
            $table->string('comentario')->nullable();
            $table->string('accion');
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
        Schema::dropIfExists('log_liquidations');
    }
}
