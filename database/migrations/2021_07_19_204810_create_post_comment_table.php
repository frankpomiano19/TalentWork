<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Post_comments', function (Blueprint $table) {
            $table->id();
            $table->text('comentario');
            $table->string('us_com',40);
            $table->string('etiqueta1',20)->nullable();
            $table->string('etiqueta2',20)->nullable();
                //$table->string('pregunta',50)->nullable();
                //$table->string('respuesta',100)->nullable();
            //$table->foreignId('serpro_id')->references('id')->on('use_occs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('post_comments');
    }
}
