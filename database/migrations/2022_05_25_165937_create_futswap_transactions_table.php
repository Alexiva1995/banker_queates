<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFutswapTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('futswap_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_purchase_id')->constrained('orden_purchases');
            $table->string('billId');
            $table->string('status');
            $table->string('token');
            $table->string('coinName');
            $table->string('address');
            $table->float('value', 10,3);
            $table->string('coinSymbol');
            $table->integer('usdValue');
            $table->string('expires');
            $table->string('time');
            $table->string('paymentUrl');
            $table->float('defaultUnitValue', 10,3);
            $table->float('totalPaid');
            $table->integer('trm');
            $table->string('recoveryFeeTransaction')->nullable();
            $table->string('transactionToMasterWallet')->nullable();
            $table->float('internalFee', 10,3);
            $table->integer('index');
            $table->string('contractAddress');
            $table->string('blockchainSymbol');
            $table->string('secret');
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
        Schema::dropIfExists('futswap_transactions');
    }
}
