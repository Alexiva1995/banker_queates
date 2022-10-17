<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->comment('Usuario al que pertenece este registro');
            $table->foreignId('buyer_id')->constrained('users')->comment('El patrocinante del usuario, es quien recibe los puntos');
            $table->foreignId('investment_id')->constrained('investments')->comment('Inversion que genera el registro');
            $table->integer('right_points_log')->default(0)->comment('Historial de puntos por el lado derecho');
            $table->integer('left_points_log')->default(0)->comment('Historial de puntos por el lado izquierdo');
            $table->integer('right_points')->default(0)->comment('Puntos generados por el lado derecho');
            $table->integer('left_points')->default(0)->comment('Puntos por el lado izquierdo');
            $table->tinyInteger('status')->comment('0 - Generado, 1 - Pagado');
            $table->date('limit_date')->comment('Fecha de vencimiento');
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
        Schema::dropIfExists('binaries');
    }
}
