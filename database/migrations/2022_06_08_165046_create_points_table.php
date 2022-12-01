<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_range', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('buyer_id')->constrained('users');
            $table->foreignId('orden_id')->constrained('orders');
            $table->integer('right_range_points')->default(0);
            $table->integer('left_range_points')->default(0);
            $table->integer('points_range_L')->default(0);
            $table->integer('points_range_R')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0 - Por cobrar 1 - Cobrados');
            $table->date('limit')->nullable();
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
        Schema::dropIfExists('points');
    }
}
