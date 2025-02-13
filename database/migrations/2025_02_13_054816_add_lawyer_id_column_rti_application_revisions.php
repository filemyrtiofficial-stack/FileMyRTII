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
        if(!Schema::hasColumn('rti_application_revisions', 'lawyer_id')) {

            Schema::table('rti_application_revisions', function (Blueprint $table) {
                $table->integer('lawyer_id')->nullable();
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
       
        if(Schema::hasColumn('rti_application_revisions', 'lawyer_id')) {

            Schema::table('rti_application_revisions', function (Blueprint $table) {
                $table->dropColumn('lawyer_id');
            });
        }
    }
};
