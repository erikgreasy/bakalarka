<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger( 'trip_id' )->unsigned();
            $table->string( 'path' );
            $table->timestamps();

            $table->foreign( 'trip_id' )->references( 'id' )->on( 'trips' )->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_images');
    }
}
