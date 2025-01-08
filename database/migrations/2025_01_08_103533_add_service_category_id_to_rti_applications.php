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
        if(!Schema::hasColumn('rti_applications', 'service_category_id')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->integer('service_category_id')->nullable();
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
        if(Schema::hasColumn('rti_applications', 'service_category_id')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('service_category_id');
            });
        }
    }
};
