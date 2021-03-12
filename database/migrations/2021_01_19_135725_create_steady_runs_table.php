<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSteadyRunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steady_runs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id')->index();
            $table->unsignedBigInteger('mesocycle_id')->index();
            $table->date('training_date');
            $table->unsignedTinyInteger('steady_run_type_id')->index();
            $table->unsignedSmallInteger('duration');
            $table->enum('duration_unit', ['meters', 'miles', 'minutes', 'seconds']);
            $table->unsignedTinyInteger('training_intensity_id')->index();
            $table->enum('training_session', ['primary', 'secondary'])->default('primary');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->cascadeOnDelete();

            $table->foreign('mesocycle_id')
                ->references('id')
                ->on('mesocycles')
                ->cascadeOnDelete();

            $table->foreign('steady_run_type_id')
                ->references('id')
                ->on('steady_run_types')
                ->cascadeOnDelete();

            $table->foreign('training_intensity_id')
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
        Schema::dropIfExists('steady_runs');
    }
}
