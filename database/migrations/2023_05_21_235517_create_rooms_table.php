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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('province_id')->unsigned();
            $table->bigInteger('district_id')->unsigned();
            $table->bigInteger('ward_id')->unsigned();
            $table->string('address_detail', 1000)->nullable();
            $table->string('maps_location')->nullable();
            $table->tinyInteger('is_negotiate')->default(1);
            $table->float('cost', 21, 3)->nullable()->comment('unit: thousand "dong"');
            $table->float('acreage', 21, 3)->comment('unit: m2');
            $table->integer('max_people_allowed')->nullable();
            $table->bigInteger('room_type_id')->unsigned();
            $table->mediumText('more_description')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1: show, 0: hidden');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('ward_id')->references('id')->on('wards');
            $table->foreign('room_type_id')->references('id')->on('room_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
