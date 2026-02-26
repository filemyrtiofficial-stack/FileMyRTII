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
        if(!Schema::hasColumn('application_close_requests', 'new_lawyer_id')) {

            Schema::table('application_close_requests', function (Blueprint $table) {
                $table->boolean('new_lawyer_id')->nullable();
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
        if(Schema::hasColumn('application_close_requests', 'new_lawyer_id')) {

            Schema::table('application_close_requests', function (Blueprint $table) {
                $table->dropColumn('new_lawyer_id');
            });
        }
    }
};
