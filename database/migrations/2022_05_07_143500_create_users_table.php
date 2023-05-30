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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->date('birthday')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email');
            $table->string('password');
            $table->tinyInteger('status')->default(1)->comment('1: new, 2: active, 3: block');
            $table->tinyInteger('notifications_email')->default(1)->comment('0: no, 1: yes');
            $table->string('google_id')->nullable();
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
        Schema::dropIfExists('users');
    }
};
