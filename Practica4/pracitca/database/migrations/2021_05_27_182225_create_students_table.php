<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {

        /**
         * EJERCICIO:
         * Agregar una nueva columna address string
         * Registrar los datos para esta nueva columna
         * 
         * 16:35
         */

            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('city');
            $table->integer('semester');
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
        Schema::dropIfExists('students');
    }
}
