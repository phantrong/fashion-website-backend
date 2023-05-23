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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('type')->default(0)->comment('1: root, 0: not root');
            $table->string('email');
            $table->string('password');
            $table->tinyInteger('status')->default(1)->comment('1: new, 2: active, 3: block');
            $table->bigInteger('create_admin')->nullable()->unsigned();
            $table->bigInteger('update_admin')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('create_admin')->references('id')->on('admins');
            $table->foreign('update_admin')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
