<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices_ports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('device_id', 30)->nullable(false)->index();
            $table->integer('port_id')->nullable(false);
            $table->integer('type')->nullable(false);//digital|analogic
            $table->boolean('allow_reading')->default(false);
            $table->boolean('allow_writing')->default(false);
            $table->timestamps();
            
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
        Schema::dropIfExists('devices_ports');
    }
}
