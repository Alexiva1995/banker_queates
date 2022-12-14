<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('package_id')->constrained('licenses_packages');
            $table->tinyInteger('payment_plataform')->default(0)->comment('0 - Coinpayments, 1 - Manual');
            $table->double('invested');
            $table->double('gain')->default(0);
            $table->double('capital');
            $table->tinyInteger('status')->default(0)->comment('0 - On standby ,1 - Active  2 - Inactive');
            $table->tinyInteger('pay_utility')->default(0)->comment('0 - Pay, 1 - No Pay');
            $table->bigInteger('buyer_id')->nullable()->unsigned()->nullable();
            $table->foreign('buyer_id')->references('id')->on('users')->onUpdate('cascade')->nullable();
            $table->date('expiration_date')->comment('La fecha de expiración de la licencia la cual es anual');
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
        Schema::dropIfExists('inversions');
    }
}
