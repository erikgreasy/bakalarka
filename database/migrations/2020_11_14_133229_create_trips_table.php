<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('hill_id')->unsigned();
            $table->bigInteger( 'duration' );
            $table->double('distance');
            $table->double('avg_speed');
            $table->timestamp('date')->useCurrent();
            $table->string( 'thumbnail_path' )->default( '/images/image-placeholder.png' );

            $table->timestamps();

            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete('cascade');
            $table->foreign( 'hill_id' )->references( 'id' )->on( 'hills' )->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
