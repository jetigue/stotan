<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressiveRunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progressive_runs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id')->index();
            $table->unsignedBigInteger('mesocycle_id')->index();
            $table->date('training_date');
            $table->unsignedTinyInteger('progressive_run_type_id');
            $table->unsignedSmallInteger('duration');
            $table->unsignedTinyInteger('starting_training_intensity_id');
            $table->unsignedTinyInteger('final_training_intensity_id');
            $table->enum('duration_unit', ['meters', 'miles', 'minutes', 'seconds']);
            $table->text('notes')->nullable();
            $table->enum('training_session', ['primary', 'secondary'])->default('primary');
            $table->unsignedSmallInteger('progression_interval');
            $table->enum('progression_interval_unit', ['meters', 'miles', 'minutes', 'seconds']);
            $table->timestamps();

            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->cascadeOnDelete();

            $table->foreign('mesocycle_id')
                ->references('id')
                ->on('mesocycles')
                ->cascadeOnDelete();

            $table->foreign('progressive_run_type_id')
                ->references('id')
                ->on('progressive_run_types')
                ->cascadeOnDelete();

            $table->foreign('starting_training_intensity_id')
                ->references('id')
                ->on('training_intensities')
                ->cascadeOnDelete();

            $table->foreign('final_training_intensity_id')
                ->references('id')
                ->on('training_intensities')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progressive_runs');
    }
}
