<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->double('amount')->comment('El precio al que se vende la licencia');
            $table->enum('commissions', [0,1])->comment('Permite saber si genera o no comissiones (bonos) 0 - No genera, 1 - Si Genera');
            $table->double('leadership_points')->comment('Puntos de liderazgo de la licencia')->nullable();
            $table->double('binary_points')->comment('Puntos binarios de la licencia')->nullable();
            $table->integer('level')->comment('El nivel maximo en red a los que permite acceso la licencia');
            $table->double('deposit_min')->comment('El deposito minimo que permite la licencia')->nullable();
            $table->double('deposit_max')->comment('El deposito maximo que permite la licencia')->nullable();
            $table->string('image')->nullable();
            $table->string('dark_image')->nullable();
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
        Schema::dropIfExists('licenses_packages');
    }
}
