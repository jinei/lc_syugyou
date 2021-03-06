<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WorkingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->string('starttime');
            $table->string('endtime');
            $table->integer('day');
            $table->integer('month');
            $table->integer('year');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
