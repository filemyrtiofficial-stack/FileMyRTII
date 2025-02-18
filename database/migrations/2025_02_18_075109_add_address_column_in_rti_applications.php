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
        if(!Schema::hasColumn('rti_applications', 'city')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->string('city')->nullable();
            });
        }
        if(!Schema::hasColumn('rti_applications', 'state')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->string('state')->nullable();
            });
        }
        if(!Schema::hasColumn('rti_applications', 'pio_expected_date')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->date('pio_expected_date')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('rti_applications', 'city')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('city');
            });
        }
        if(Schema::hasColumn('rti_applications', 'state')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('state');
            });
        }
        if(Schema::hasColumn('rti_applications', 'pio_expected_date')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->ddropColumnate('pio_expected_date');
            });
        }
    }
};
