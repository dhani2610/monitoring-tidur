<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFitToWorksTable extends Migration
{
    /**
     * Ru n the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fit_to_works', function (Blueprint $table) {
            $table->id();
            $table->string('time_sleep_start')->nullable();
            $table->string('time_sleep_end')->nullable();
            $table->string('total_sleep')->nullable();
            $table->string('heart_rate_min')->nullable();
            $table->string('heart_rate_max')->nullable();
            $table->string('average_bpm')->nullable();
            $table->integer('shift')->nullable();
            $table->string('quest1')->nullable();
            $table->string('quest2')->nullable();
            $table->string('quest3')->nullable();
            $table->integer('pembuat')->nullable();
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
        Schema::dropIfExists('fit_to_works');
    }
}
