<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppointmentDateToAppointmentModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_models', function (Blueprint $table) {
            $table->date('appointment_date')->after('title')->nullbale();
            $table->time('appointment_time')->after('appointment_date')->nullbale();
        });

        Schema::table('appointment_models', function($table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('time_from');
            $table->dropColumn('time_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointment_models', function (Blueprint $table) {
            $table->date('start_date');
            $table->date('end_date');
            $table->time('time_from');
            $table->time('time_to');
        });
    }
}
