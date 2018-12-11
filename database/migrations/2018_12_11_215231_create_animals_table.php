<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('species');
            $table->string('name');
            $table->string('source');
            $table->string('microchip_number')->nullable()->default(null);
            $table->string('gender');
            $table->date('birthdate');
            $table->string('breed');
            $table->text('description')->nullable()->default(null);
            $table->integer('weight');
            $table->boolean('fixed'); 
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
        Schema::dropIfExists('animals');
    }
}
