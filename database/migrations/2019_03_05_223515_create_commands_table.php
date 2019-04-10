<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('device_id', 30);
            $table->integer('pin');//pin to use            
            $table->integer('type'); //if digital or analogic            
            $table->integer('action'); //if should activate, deactivate, etc...            
            $table->string('name',30)->default(''); //command name
            $table->dateTime('date');
            $table->boolean('pending');
            $table->timestamps();            
            
            $table->index(['device_id', 'pending']);
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');            
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
