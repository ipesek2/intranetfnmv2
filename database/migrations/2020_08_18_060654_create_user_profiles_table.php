<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->string("ime");
            $table->string("priimek");
            $table->integer("naziv_id")->unsigned();
            $table->integer("enota_id")->unsigned();
            $table->smallInteger("spol");
            $table->boolean("aktiven");
            $table->dateTime("izvolitev_do")->nullable();
            $table->integer("potrjevanje")->comment("predstojnik = 0, sicer id osebe");
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
        Schema::dropIfExists('user_profiles');
    }
}
