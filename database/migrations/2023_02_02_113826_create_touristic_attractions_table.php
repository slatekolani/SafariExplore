<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristicAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touristic_attractions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('attraction_name');
            $table->string('attraction_description');
            $table->string('attraction_category');
            $table->string('GPS_url');
            $table->string('uuid',100)->unique();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('touristic_attractions');
    }
}
