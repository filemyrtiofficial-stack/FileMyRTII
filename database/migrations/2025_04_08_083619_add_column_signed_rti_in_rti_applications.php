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
        if(!Schema::hasColumn('rti_applications', 'signed_rti')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->text('signed_rti')->nullable();
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
        if(Schema::hasColumn('rti_applications', 'signed_rti')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('signed_rti');
            });
        }
    }
};
