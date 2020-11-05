<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTroubleshootingReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('troubleshooting_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_machine');
            $table->unsignedBigInteger('id_technicien');

            $table->timestamps();
            $table->dateTime('end_date');
            $table->dateTime('start_date');
            $table->text('troubleshooting_description');
            $table->text('troubleshooting_hypotesis');
            $table->text('troubleshooting_check');
            $table->text('repairs_actions');
            $table->string('piece_to_change');
            $table->binary('piece_photo');
            $table->boolean('resolved');

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
        Schema::dropIfExists('troubleshooting_reports');
    }
}
