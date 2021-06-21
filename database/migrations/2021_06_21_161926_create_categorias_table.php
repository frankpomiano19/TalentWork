<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD:database/migrations/2021_06_21_161926_create_categorias_table.php
class CreateCategoriasTable extends Migration
=======
class CreateServiceTalentTable extends Migration
>>>>>>> d7ceea890afe0c0ff5979daa71cca43ccdd9b76b:database/migrations/2021_06_20_184804_create_service_talent_table.php
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD:database/migrations/2021_06_21_161926_create_categorias_table.php
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_categoria');
=======
        Schema::create('service_talent', function (Blueprint $table) {
            $table->id();
            $table->char('ser_tal_name');
>>>>>>> d7ceea890afe0c0ff5979daa71cca43ccdd9b76b:database/migrations/2021_06_20_184804_create_service_talent_table.php
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
<<<<<<< HEAD:database/migrations/2021_06_21_161926_create_categorias_table.php
        Schema::dropIfExists('categorias');
=======
        Schema::dropIfExists('service_talent');
>>>>>>> d7ceea890afe0c0ff5979daa71cca43ccdd9b76b:database/migrations/2021_06_20_184804_create_service_talent_table.php
    }
}
