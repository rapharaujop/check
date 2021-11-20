<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserContracts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('salesman');
            $table->unsignedBigInteger('contract');
            $table->timestamps();

            $table->foreign('salesman')->references('email')->on("users")->onDelete('CASCADE');
            $table->foreign('contract')->references('id')->on("contratcts")->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_contracts');
    }
}
