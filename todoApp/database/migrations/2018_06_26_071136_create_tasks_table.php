<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('bgcolor',20)->default('#ffffff');
            $table->string('txtcolor',20)->default('#000000');
            $table->string('frmcolor',20)->default('5px solid #000000');
            $table->string('labels',500)->nullable(); 
            $table->integer('pin')->default(0);;          
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
        Schema::dropIfExists('tasks');
    }
}
