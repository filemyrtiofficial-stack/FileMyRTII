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
        if(!Schema::hasColumn('rti_applications', 'rti_appeal_id')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->integer('rti_appeal_id')->nullable();
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
        if(Schema::hasColumn('rti_applications', 'rti_appeal_id')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('rti_appeal_id');
            });
        }
    }
};
