<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_packages', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->double('rentability');
            $table->foreignId('membership_types_id')->constrained('membership_types');
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
        Schema::dropIfExists('membership_packages');
    }
}
