<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_machine');
            $table->unsignedBigInteger('id_technicien');

            $table->timestamps();
            $table->dateTime('end_date');
            $table->dateTime('start_date');

            $table->foreign('id_machine')->references('id')->on('machines');
            $table->foreign('id_technicien')->references('id')->on('techniciens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintains');
    }
}
