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
        Schema::create('verifies', function (Blueprint $table) {
            $table->id();
            $table->string('email_phone')->comment('email or phone');
            $table->string('code_verify');
            $table->tinyInteger('type')->default(1)->comment('1:first setting pwd, 2:change pwd');
            $table->tinyInteger('user_role')->comment('1:admin, 2:user');
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
        Schema::dropIfExists('verifies');
    }
};
