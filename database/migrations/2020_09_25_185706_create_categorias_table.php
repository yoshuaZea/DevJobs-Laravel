<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('experiencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('ubicacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('salarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('vacantes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('imagen');
            $table->text('descripcion');
            $table->text('skills');
            $table->boolean('activa')->default(true);
            // $table->unsignedBigInteger('categoria_id');
            // $table->unsignedBigInteger('experiencia_id');
            // $table->unsignedBigInteger('ubicacion_id');
            // $table->unsignedBigInteger('salario_id');
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            // $table->foreign('experiencia_id')->references('id')->on('experiencias')->onDelete('cascade');
            // $table->foreign('ubicacion_id')->references('id')->on('ubicacions')->onDelete('cascade');
            // $table->foreign('salario_id')->references('id')->on('salarios')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            $table->foreignId('experiencia_id')->constrained()->onDelete('cascade');
            $table->foreignId('ubicacion_id')->constrained()->onDelete('cascade');
            $table->foreignId('salario_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('vacantes');
        Schema::dropIfExists('salarios');
        Schema::dropIfExists('ubicacions');
        Schema::dropIfExists('experiencias');
        Schema::dropIfExists('categorias');
    }
}
