<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->integer('amount');
            $table->string('hash')->nullable();
            $table->string('image')->nullable();
            $table->enum('type', ['anual', 'Bronce', 'Plata', 'Oro', 'Platino']);
            $table->enum('status', [0, 1, 2])->default(0)->comment('0 - En Espera, 1 - Completada, 2 - Rechazada');
            $table->foreignId('license_packages_id')->nullable()->constrained('licenses_packages');
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
        Schema::dropIfExists('orden_purchases');
    }
}
