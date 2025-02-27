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
        if(!Schema::hasColumn('application_close_requests', 'request_type')) {

            Schema::table('application_close_requests', function (Blueprint $table) {
                $table->string('request_type')->default('new');
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
        if(Schema::hasColumn('application_close_requests', 'request_type')) {

            Schema::table('application_close_requests', function (Blueprint $table) {
                $table->dropColumn('request_type');
            });
        }
    }
};
