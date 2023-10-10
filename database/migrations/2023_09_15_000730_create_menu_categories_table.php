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
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['Burgers', 'Pizzas', 'Salads', 'Breakfast', 'Seafood', 'Desserts']);

            $table->foreignId('restaurant_id')->references('id')->on('restaurants')->onUpdate('cascade')->onDelete('cascade');

            //  $table->uuid('restaurant_id');
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
        Schema::dropIfExists('menu_categories');
    }
};
