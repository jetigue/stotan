<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMacrocyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('macrocycles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->date('begin_date');
            $table->date('end_date');
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
        Schema::dropIfExists('macrocycles');
    }
}
