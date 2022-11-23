<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasarelaTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasarela_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->string('status');
            $table->string('crypto');
            $table->decimal('amount', 10,3);
            $table->string('uuid');
            $table->string('hash')->nullable();
            $table->float('amount_to_recieve', 10,3)->nullable();
            $table->float('amount_to_send', 10,3)->nullable();
            $table->string('wallet_to_transfer')->nullable();
            
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
        Schema::dropIfExists('pasarela_transactions');
    }
}
