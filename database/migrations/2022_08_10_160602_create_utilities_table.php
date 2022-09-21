<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('investment_id')->nullable()->constrained('investments');
            $table->double('amount');
            $table->double('amount_retired')->default(0);
            $table->double('amount_available')->default(0);
            $table->double('accumulated_percentage')->nullable();
            $table->enum('status', [0, 1, 2, 3, 4])->default(0)->comment('0 - En Espera, 1 - Pagada, 2 - Cancelada, 3 - Por Liquidar, 4 - Bloqueada');
            $table->enum('last_utility', [0, 1])->default(1)->comment('0 - Falso, 1 - Es la ultima');
            $table->foreignId('utility_log')->nullable()->constrained('utilities');
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
        Schema::dropIfExists('utilities');
    }
}
