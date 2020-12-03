<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHillImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hill_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger( 'hill_id' )->unsigned();
            $table->string( 'path' );
            $table->timestamps();

            $table->foreign( 'hill_id' )->references( 'id' )->on( 'hills' )->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hill_images');
    }
}
