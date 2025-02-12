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
        if(!Schema::hasColumn('rti_applications', 'process_status')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->boolean('process_status')->default(true);
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
        if(Schema::hasColumn('rti_applications', 'process_status')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('process_status');
            });
        }
    }
};
