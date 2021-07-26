<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('pregunta',90);
            $table->text('respuesta');
            // $table->unsignedBigInteger('use_id');
            $table->unsignedBigInteger('use_occ_id')->nullable();
            $table->unsignedBigInteger('use_tal_id')->nullable();
            $table->foreign('use_tal_id')->references('id')->on('use_tals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('use_occ_id')->references('id')->on('use_occs')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('use_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    // public function up()
    // {
    //     Schema::create('questions', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('pregunta',90);
    //         $table->text('respuesta');
    //         $table->string('etiqueta_1',20)->nullable();
    //         $table->string('etiqueta_2',20)->nullable();
    //         $table->timestamps();
    //     });
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
