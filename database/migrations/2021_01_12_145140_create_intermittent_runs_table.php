<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntermittentRunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intermittent_runs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id')->index();
            $table->unsignedBigInteger('mesocycle_id')->index();
            $table->unsignedBigInteger('training_day_id');
            $table->unsignedTinyInteger('intermittent_run_type_id');
            $table->unsignedTinyInteger('number_sets')->default(1);
            $table->unsignedTinyInteger('number_repetitions');
            $table->unsignedSmallInteger('duration');
            $table->unsignedTinyInteger('training_intensity_id');
            $table->enum('duration_unit', ['meters', 'miles', 'minutes', 'seconds']);
            $table->unsignedSmallInteger('recovery');
            $table->enum('recovery_unit', ['meters', 'miles', 'minutes', 'seconds']);
            $table->enum('recovery_type', ['jog', 'walk', 'rest']);
            $table->text('notes')->nullable();
            $table->enum('training_session', ['primary', 'secondary'])->default('primary');
            $table->unsignedSmallInteger('set_recovery')->nullable();
            $table->enum('set_recovery_unit', ['meters', 'miles', 'minutes', 'seconds'])->nullable();
            $table->enum('set_recovery_type', ['jog', 'walk', 'rest'])->nullable();
            $table->timestamps();

            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->cascadeOnDelete();

            $table->foreign('mesocycle_id')
                ->references('id')
                ->on('mesocycles')
                ->cascadeOnDelete();

            $table->foreign('training_day_id')
                ->references('id')
                ->on('training_days')
                ->cascadeOnDelete();

            $table->foreign('intermittent_run_type_id')
                ->references('id')
                ->on('intermittent_run_types')
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
        Schema::dropIfExists('intermittent_runs');
    }
}
