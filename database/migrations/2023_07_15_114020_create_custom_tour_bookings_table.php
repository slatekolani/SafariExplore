<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomTourBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_tour_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tourist_name');
            $table->string('tourist_email_address');
            $table->string('tourist_country');
            $table->string('tourist_phone_number');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('total_adult_travellers');
            $table->string('total_children_travellers');
            $table->text('message');
            $table->unsignedBigInteger('tour_operator_id');
            $table->string('status')->default(0);
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('custom_tour_bookings',function (Blueprint $table){
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
        Schema::dropIfExists('custom_tour_bookings');
    }
}
