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
        if(!Schema::hasColumn('rti_applications', 'payment_id')) {
            Schema::table('rti_applications', function (Blueprint $table) {
                $table->string('payment_id')->nullable();
            });
        }

        if(!Schema::hasColumn('rti_applications', 'success_response')) {
            Schema::table('rti_applications', function (Blueprint $table) {
                $table->text('success_response')->nullable();
            });
        }
        if(!Schema::hasColumn('rti_applications', 'error_response')) {
            Schema::table('rti_applications', function (Blueprint $table) {
                $table->text('error_response')->nullable();
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
        if(Schema::hasColumn('rti_applications', 'payment_id')) {
            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('payment_id');
            });
        }

        if(Schema::hasColumn('rti_applications', 'success_response')) {
            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('success_response');
            });
        }
        if(Schema::hasColumn('rti_applications', 'error_response')) {
            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('error_response');
            });
        }
    }
};
