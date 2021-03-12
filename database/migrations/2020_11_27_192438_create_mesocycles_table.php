<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesocyclesTable extends Migration
{
    /**
     * Run the migrations.
     *z
     * @return void
     */
    public function up()
    {
        Schema::create('mesocycles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->date('begin_date');
            $table->date('end_date');
            $table->unsignedTinyInteger('color_id');
            $table->enum('microcycle_length', ['7', '10', '14'])->default('7');
            $table->enum('view', ['table', 'calendar'])->default('table');
            $table->string('slug')->unique();
            $table->foreignId('macrocycle_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('team_id')->index();
            $table->timestamps();

            $table->foreign('color_id')
                ->references('id')
                ->on('colors');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mesocycles');
    }
}
