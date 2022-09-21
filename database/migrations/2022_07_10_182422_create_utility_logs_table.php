<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utility_logs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('percentage');
            $table->enum('status', [0, 1, 2])->default(0)->comment('0 - En Espera, 1 - Completada, 2 - Rechazada');
            $table->string('image');
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
        Schema::dropIfExists('utility_logs');
    }
}
