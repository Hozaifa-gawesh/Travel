<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers_cities', function (Blueprint $table) {
            $table->id();
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('duration');
            $table->enum('room_type', ['single', 'double']);

            $table->bigInteger('hotel_id')->unsigned()->index();
            $table->foreign('hotel_id', 'HOTEL_OFFERS_CITIES_ID_FK')->references('id')->on('hotels')->onDelete('cascade');

            $table->bigInteger('city_id')->unsigned()->index();
            $table->foreign('city_id', 'CITY_OFFERS_CITIES_ID_FK')->references('id')->on('cities')->onDelete('cascade');

            $table->bigInteger('offer_id')->unsigned()->index();
            $table->foreign('offer_id', 'OFFER_CITY_OFFERS_ID_FK')->references('id')->on('offers')->onDelete('cascade');

            $table->unique(['offer_id', 'city_id']);
            $table->unique(['offer_id', 'hotel_id']);

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
        Schema::dropIfExists('offers_cities');
    }
}
