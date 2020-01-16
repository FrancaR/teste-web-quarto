<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_photos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('url');

            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_photos');
    }
}
