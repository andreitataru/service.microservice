<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('providerId');
            $table->string('name');
            $table->string('location');
            $table->decimal('priceHour');
            $table->string('serviceType');
            $table->string('description');
            $table->decimal('rating', $precision = 1, $scale = 1)->default(0); //0-5
            $table->bigInteger('minHourDay');
            $table->bigInteger('maxHourDay');
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
        Schema::dropIfExists('messages');
    }
}
