<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger ( 'trip_id' )->unsigned();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longtitude', 11, 8);
            $table->timestamp( 'time' )->useCurrent();
            $table->timestamps();
            $table->double( 'speed' );

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
        Schema::dropIfExists('logs');
    }
}
