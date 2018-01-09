<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meditions', function (Blueprint $table){
            $table->increments('id');
            $table->float('medition');
            $table->integer('user_id');
            $table->integer('sensor_id');
            $table->integer('invoice_id')->nullable();
            $table->boolean('paid')->default(false);
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meditions');
    }
}
