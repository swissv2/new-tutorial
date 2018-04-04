<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movie_id')->unsigned();                    //fk->movie. Constraint
            $table->integer('user_id')->unsigned();                     //fk->user. Constraint
            $table->integer('backing_id')->unsigned()->default('1');    //fk->support type. Non constraint
            $table->boolean('donated')->nullable();
            $table->integer('donated_amount')->unsigned()->nullable();
            $table->boolean('purchased')->nullable();
            $table->integer('purchased_amount')->unsigned()->nullable();
           
            $table->timestamps();

            //List foreign key constraints
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('movie_id')->references('id')->on('movies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
