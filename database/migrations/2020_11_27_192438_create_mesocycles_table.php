<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesocyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesocycles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->date('begin_date');
            $table->date('end_date');
            $table->string('color', 7);
            $table->foreignId('macrocycle_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('team_id')->index();
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
        Schema::dropIfExists('mesocycles');
    }
}
