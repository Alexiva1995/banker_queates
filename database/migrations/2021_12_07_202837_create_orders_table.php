<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->comment('ID del usuario al que pertenece');
            $table->foreignId('package_id')->constrained('licenses_packages');
            $table->double('amount');
            $table->string('hash')->nullable();
            $table->string('voucher')->nullable();
            $table->double('fee')->comment('porcentaje de comisión');
            $table->enum('status', [0, 1, 2])->default(0)->comment('0 - Pending, 1 - Completed,2 - Canceled');
            $table->enum('type', [0, 1])->default(0)->comment('0 - Buy, 1 - Buyback');
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
        Schema::dropIfExists('orders');
    }
}
