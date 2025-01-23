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
        if(!Schema::hasColumn('rti_applications', 'payment_details')) {
            Schema::table('rti_applications', function (Blueprint $table) {

                $table->text('payment_details')->nullable();
            });
        }
        
        if(!Schema::hasColumn('rti_applications', 'signature_type')) {
            Schema::table('rti_applications', function (Blueprint $table) {

                $table->string('signature_type')->nullable();
            });
        }

        if(!Schema::hasColumn('rti_applications', 'signature_image')) {
            Schema::table('rti_applications', function (Blueprint $table) {

                $table->string('signature_image')->nullable();
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
        if(Schema::hasColumn('rti_applications', 'payment_details')) {
            Schema::table('rti_applications', function (Blueprint $table) {

                $table->dropColumn('payment_details');
            });
        }
        if(Schema::hasColumn('rti_applications', 'signature_type')) {
            Schema::table('rti_applications', function (Blueprint $table) {

                $table->dropColumn('signature_type');
            });
        }

        if(Schema::hasColumn('rti_applications', 'signature_image')) {
            Schema::table('rti_applications', function (Blueprint $table) {

                $table->dropColumn('signature_image');
            });
        }
    }
};
