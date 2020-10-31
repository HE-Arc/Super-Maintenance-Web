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