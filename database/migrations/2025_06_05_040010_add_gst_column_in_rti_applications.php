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
        if(!Schema::hasColumn('rti_applications', 'gst')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->float('gst')->nullable();
            });
        }
        if(!Schema::hasColumn('rti_applications', 'final_price')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->float('final_price')->nullable();
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
        if(Schema::hasColumn('rti_applications', 'gst')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('gst');
            });
        }
        if(Schema::hasColumn('rti_applications', 'final_price')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('final_price');
            });
        }
    }
};
