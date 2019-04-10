<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->string('id', 30)->primary(); //mac address
            $table->integer('account_id')->nullable();
            $table->boolean('active')->default(true)->index();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
            
            $table->index(['id', 'active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
