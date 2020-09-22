<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->decimal('adult_price')->comment('price for person');
            $table->decimal('child_price')->comment('price for person');
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('duration');
            $table->string('image');
            $table->json('gallery')->default('[]');

            $table->bigInteger('country_id')->unsigned()->index();
            $table->foreign('country_id', 'COUNTRY_OFFER_ID_FK')->references('id')->on('countries')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id', 'USER_OFFER_ID_FK')->references('id')->on('users')->onDelete('set null');

            $table->unique(['country_id', 'title']);

            $table->boolean('hide')->default(0);
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
        Schema::dropIfExists('offers');
    }
}
