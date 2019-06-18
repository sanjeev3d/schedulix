<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeFormateToBusinessOtherDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_other_details', function (Blueprint $table) {
            $table->text('time_formate')->nullable()->change();
            $table->text('date_formate')->nullable()->change();
            $table->text('currency')->nullable()->change();
            $table->text('currency_formate')->nullable()->change();
            $table->string('language_pref')->nullable()->change();
            $table->string('select_language')->nullable()->change();
            $table->string('home_phone')->nullable()->change();
            $table->string('work_phone')->nullable()->change();
            $table->text('business_logo')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_other_details', function (Blueprint $table) {
            $table->dropColumn('time_formate');
            $table->dropColumn('date_formate');
            $table->dropColumn('currency');
            $table->dropColumn('currency_formate');
            $table->dropColumn('language_pref');
            $table->dropColumn('select_language');
            $table->dropColumn('home_phone');
            $table->dropColumn('work_phone');
            $table->dropColumn('business_logo');
        });
    }
}
