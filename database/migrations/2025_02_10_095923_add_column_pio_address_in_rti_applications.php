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
        if(!Schema::hasColumn('rti_applications', 'pio_address')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->text('pio_address')->nullable();
            });
        }

        if(!Schema::hasColumn('rti_applications', 'manual_pio')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->boolean('manual_pio')->default(0);
            });
        }

        if(!Schema::hasColumn('rti_applications', 'customer_pio_address')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->text('customer_pio_address')->nullable();
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
        if(Schema::hasColumn('rti_applications', 'pio_address')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('pio_address');
            });
        }

        if(Schema::hasColumn('rti_applications', 'manual_pio')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('manual_pio');
            });
        }

        if(Schema::hasColumn('rti_applications', 'customer_pio_address')) {

            Schema::table('rti_applications', function (Blueprint $table) {
                $table->dropColumn('customer_pio_address');
            });
        }
    }
};
