<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets_commissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned()->comment('usuario al que le pertenece la wallet');
            $table->foreign('user_id')->nullable()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('buyer_id')->nullable()->unsigned()->nullable();
            $table->foreign('buyer_id')->references('id')->on('users')->onUpdate('cascade')->nullable();
            $table->bigInteger('order_id')->nullable()->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->nullable(); 
            $table->bigInteger('level');
            $table->string('description',100);
            $table->foreignId('investment_id')->nullable()->constrained('investments')->comment('inversion la cual produce esta wallet');
            $table->double('amount')->nullable()->comment('amount for display');
            $table->double('amount_retired')->nullable()->comment('amount retired for calculations');
            $table->double('amount_available')->nullable()->comment('amount for calculations');
            $table->double('amount_last_liquidation')->nullable()->comment('amount last settlement');
            $table->tinyInteger('type')->default(0)->comment('0 - commission, 1 - Range, 2 - license, 3 - withdrawable');
            $table->bigInteger('liquidation_id')->unsigned()->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 - Available, 1 - Requested, 2 - Paid, 3 - Voided');
            $table->tinyInteger('avaliable_withdraw')->default(0)->comment('0 - no Disponible, 1 - Disponible');
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
        Schema::dropIfExists('wallets');
    }
}
