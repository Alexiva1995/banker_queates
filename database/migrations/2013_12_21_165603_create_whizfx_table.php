<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhizfxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whizfx', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->nullable()->unique();
            $table->integer('customer_id')->nullable();
            $table->double('balance')->nullable();
            $table->integer('kyc_percentage')->nullable();
            $table->string('lpoa_file')->nullable();
            $table->enum('status', [0, 1, 2])->default(0)->comment('0 - inactivo, 1 - activo, 2 - Inactivo');
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
        Schema::dropIfExists('whizfxes');
    }
}
