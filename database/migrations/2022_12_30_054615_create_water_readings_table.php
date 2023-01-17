<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_readings', function (Blueprint $table) {
            $table->id();
            $table->string('unit_no');

            $table->mediumInteger('previous');
            $table->mediumInteger('current');
            // $table->double('rate');
            // $table->string('month');
            // $table->string('year');
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
        Schema::dropIfExists('water_readings');
    }
}
