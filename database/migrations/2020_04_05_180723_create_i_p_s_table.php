<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('address')->unique();

//            $table->foreignId('user_id')->nullable()->constrained();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('last_modified')->nullable();
            $table->foreign('last_modified')->references('id')->on('users');

            $table->string('hostname')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('last_modified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i_p_s');
    }
}
