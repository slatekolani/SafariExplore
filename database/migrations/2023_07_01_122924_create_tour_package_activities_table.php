<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourPackageActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_package_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('activity_name');
            $table->string('activity_description');
            $table->unsignedBigInteger('tour_package_id');
            $table->unsignedBigInteger('tour_operator_id');
            $table->string('uuid',100);
            $table->timestamps();
        });
        Schema::table('tour_package_activities',function (Blueprint $table){
            $table->foreign('tour_package_id')->references('id')->on('tour_package')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_package_activities');
    }
}
