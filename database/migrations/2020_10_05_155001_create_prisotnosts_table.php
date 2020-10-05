<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrisotnostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prisotnosts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->dateTime('datum');
            $table->integer('tip_prisotnost_id');
            $table->smallInteger('stevilo_ur');
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
        Schema::dropIfExists('prisotnosts');
    }
}
