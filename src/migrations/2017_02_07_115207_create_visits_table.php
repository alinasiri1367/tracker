<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('count');
            $table->bigInteger('real_count');
            $table->timestamps();
        });

	    Schema::create('visitors', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('ip',30);
		    $table->string('user_agent',333);
		    $table->string('from_page',255);
		    $table->string('to_page',255);
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
        Schema::dropIfExists('visits');
    }
}
