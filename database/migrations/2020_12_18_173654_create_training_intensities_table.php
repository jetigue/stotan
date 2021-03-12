<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingIntensitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_intensities', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 50);
            $table->string('percentVO2Max', 20);
            $table->string('percentMaxHR', 20);
            $table->text('description');
            $table->text('purpose');
            $table->unsignedSmallInteger('jd_points');
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
        Schema::dropIfExists('training_intensities');
    }
}
