<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('streetAddress');
            $table->string('city');
            $table->string('state');
            $table->string('tage');
            $table->enum('cuisineType', ['Italian', 'Mexican', 'Chinese', 'Japanese', 'Indian', 'French', 'American', 'Spanish', 'Thai', 'Greek', 'Other']);
            $table->double('rating');
            $table->time('startWorkingTime');
            $table->time('finishWorkingTime');
            $table->string('imageUrl')->nullable();
            $table->string('logoUrl')->nullable();

            $table->double('latitude');
            $table->double('longitude');


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
        Schema::dropIfExists('restaurants');
    }
};
