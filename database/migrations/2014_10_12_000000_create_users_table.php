<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->nullable()->references('id')->on('users')->comment('ID del usuario patrocinador');
            $table->foreignId('countrie_id')->nullable()->constrained('countries')->comment('el id del pais del usuario');
            $table->foreignId('prefix_id')->nullable()->constrained('prefixes')->comment('el id del prefijo del tlf');
            $table->bigInteger('binary_id')->default(1)->comment('ID del usuario binario')->nullable();
            $table->enum('binary_side', ['L', 'R'])->default('L')->comment('Permite saber porque lado va a registrar a un nuevo usuario');
            $table->string('username')->nullable()->unique();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('admin', [0, 1])->default(0)->comment('permite saber si un usuario es admin o no');
            $table->enum('status', [0, 1, 2])->default(0)->comment('0 - inactivo, 1 - activo, 2 - eliminado');
            $table->date('date_active')->nullable();
            $table->string('birthdate')->nullable()->comment('Fecha de nacimiento del usuario');
            $table->string('type_dni')->nullable()->comment('tipo de identificacion del usuario');
            $table->enum('gender', [0, 1])->nullable()->comment('0 - masculino, 1 - femenino');
            $table->string('phone')->nullable();
            $table->string('activar_2fact')->nullable();
            $table->string('token_auth')->nullable();
            $table->string('code_security', 255)->nullable();
            $table->string('app_mode')->default('light')->comment('El modo de la app si dark o light');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
