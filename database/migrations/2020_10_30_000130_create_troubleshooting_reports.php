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
            $table->unsignedBigInteger('id_maintainer');

            $table->timestamps();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->text('troubleshooting_description')->nullable();
            $table->text('troubleshooting_hypotesis')->nullable();
            $table->text('troubleshooting_check')->nullable();
            $table->text('repairs_actions')->nullable();
            $table->string('piece_to_change')->nullable();
            $table->binary('piece_photo')->nullable();
            $table->boolean('resolved')->nullable();

            $table->foreign('id_machine')->references('id')->on('machines');
            $table->foreign('id_maintainer')->references('id')->on('maintainers');
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
