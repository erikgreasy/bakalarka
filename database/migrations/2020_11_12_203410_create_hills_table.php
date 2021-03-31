<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('height');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->bigInteger('mountain_id')->unsigned();
            $table->timestamps();

            $table->foreign( 'mountain_id' )->references( 'id' )->on( 'mountains' )->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hills');
    }
}
