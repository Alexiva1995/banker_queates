<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->double('amount_gross')->comment('full amount');
            $table->double('amount_net')->comment('amount to receive');
            $table->double('amount_fee')->comment('withdrawal commission');
            $table->string('hash')->nullable();
            $table->string('description')->nullable();
            $table->string('wallet_used', 350)->nullable();
            $table->string('code_correo',15)->nullable();
            $table->timestamp('fecha_code')->nullable();
            $table->tinyInteger('type')->default(0)->comment('0 - Commissions, 1 - Utility, 2 - Range');
            $table->tinyInteger('status')->default(0)->comment('0 - waiting, 1 - paid, 2-cancelled');
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
        Schema::dropIfExists('liquidations');
    }
}
