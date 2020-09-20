<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('farmId');
            $table->string('address');
            $table->string('phoneNumber');
            $table->string('additionalData1')->nullable();
            $table->string('additionalData2')->nullable();
            $table->string('additionalData3')->nullable();
            $table->string('additionalData4')->nullable();
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
        Schema::dropIfExists('farmers');
    }
}
