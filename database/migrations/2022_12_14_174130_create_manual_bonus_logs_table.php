<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualBonusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_bonus_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action')->comment('La accion realizada');
            $table->double('amount')->comment('el monto de la operación');
            $table->foreignId('user_id')->constrained('users')->comment('El usuario que recibio la acción');
            $table->foreignId('author_id')->constrained('users')->comment('El usuario que realizo la acción');
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
        Schema::dropIfExists('manual_bonus_logs');
    }
}
