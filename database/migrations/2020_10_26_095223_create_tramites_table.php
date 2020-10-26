<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTramitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departamento_id')->references('id')->on('departamentos');
            $table->foreignId('tipousuario_id')->references('id')->on('tipousuarios');
            $table->foreignId('dependencia_id')->references('id')->on('dependencias');
            $table->string('nombre')->nullable(false);
            $table->string('objetivo')->nullable();
            $table->string('documento_obtenido')->nullable();
            $table->string('datos_institucionales')->nullable();
            $table->smallInteger('plazo_respuesta')->nullable(false);
            $table->decimal('costo', 8, 2);
            $table->string('url_proceso')->nullable();
            $table->boolean('activo');
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
        Schema::dropIfExists('tramites');
    }
}
