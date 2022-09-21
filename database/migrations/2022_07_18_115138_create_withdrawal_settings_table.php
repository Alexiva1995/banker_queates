+<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal_settings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('day_start');
            $table->tinyInteger('day_end');
            $table->time("time_start");
            $table->time("time_end");
            $table->tinyInteger('percentage');
            $table->tinyInteger('transferencias_entre_users')->default(0)->comment('0 - transferencias entre usuarios desactivada, 1 - transferencias entre usuarios activada');
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
        Schema::dropIfExists('withdrawal_settings');
    }
}
