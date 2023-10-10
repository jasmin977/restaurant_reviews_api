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
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            // $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description');
            $table->float('price');
            $table->double('rating');
            $table->string('url');

            //$table->integer('menu_category_id')->unsigned()->nullable()->default(null);
            $table->foreignId('menu_category_id')->references('id')->on('menu_categories')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('meals');
    }
};
