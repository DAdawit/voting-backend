<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuMemebersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('su__memebers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('department');
            $table->string('college');
            $table->string('sex');
            $table->string('id_number')->unique();
            $table->integer('suid')->unique();
            $table->timestamps();
        });
    }
//125619
//103418
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('su__memebers');
    }
}
