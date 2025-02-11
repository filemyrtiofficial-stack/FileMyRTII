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
       
        if(!Schema::hasColumn('pio_masters', 'mandal')) {

            Schema::table('pio_masters', function (Blueprint $table) {
                $table->string('mandal')->nullable();
            });
        }

        if(!Schema::hasColumn('pio_masters', 'tahsildar')) {

            Schema::table('pio_masters', function (Blueprint $table) {
                $table->string('tahsildar')->nullable();
            });
        }
        if(!Schema::hasColumn('pio_masters', 'department')) {

            Schema::table('pio_masters', function (Blueprint $table) {
                $table->string('department')->nullable();
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
        
        if(Schema::hasColumn('pio_masters', 'mandal')) {

            Schema::table('pio_masters', function (Blueprint $table) {
                $table->dropColumn('mandal');
            });
        }

        if(Schema::hasColumn('pio_masters', 'tahsildar')) {

            Schema::table('pio_masters', function (Blueprint $table) {
                $table->dropColumn('tahsildar');
            });
        }
        if(Schema::hasColumn('pio_masters', 'department')) {

            Schema::table('pio_masters', function (Blueprint $table) {
                $table->dropColumn('department');
            });
        }
    }
};
