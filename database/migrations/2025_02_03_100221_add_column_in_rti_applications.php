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
        if(!Schema::hasColumn('rti_applications', 'appeal_no')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->integer('appeal_no')->default(0);
            });
        }

        if(!Schema::hasColumn('rti_applications', 'application_id')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->integer('application_id')->nullable();
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
        if(Schema::hasColumn('rti_applications', 'appeal_no')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('appeal_no');
            });
        }
        if(Schema::hasColumn('rti_applications', 'application_id')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('application_id');
            });
        }
    }
};
