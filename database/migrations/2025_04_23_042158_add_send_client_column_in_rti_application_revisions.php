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
        if(!Schema::hasColumn('rti_application_revisions', 'send_client')) {

            Schema::table('rti_application_revisions', function (Blueprint $table) {
                $table->boolean('send_client')->default(1);
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
        if(Schema::hasColumn('rti_application_revisions', 'send_client')) {

            Schema::table('rti_application_revisions', function (Blueprint $table) {
                $table->dropColumn('send_client');
            });
        }
    }
};
