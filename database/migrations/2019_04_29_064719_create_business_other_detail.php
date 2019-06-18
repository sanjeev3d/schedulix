<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessOtherDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       /* Schema::table('business_category', function (Blueprint $table) {
            //
            $table->string('commnet');
        });*/

        Schema::create('business_other_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('business_id');
            $table->integer('user_id');
            $table->string('profession_name');
            $table->string('business_phone');
            $table->text('time_formate')->nullable();
            $table->text('date_formate')->nullable();
            $table->text('currency')->nullable();
            $table->text('currency_formate')->nullable();
            $table->string('language_pref')->nullable();
            $table->string('select_language')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->text('business_logo')->nullable();
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
        Schema::dropIfExists('business_other_details');
    }
}