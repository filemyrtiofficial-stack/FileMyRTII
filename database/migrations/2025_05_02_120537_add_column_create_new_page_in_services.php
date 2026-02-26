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
        if(!Schema::hasColumn('services', 'create_new_page')) {

            Schema::table('services', function (Blueprint $table) {
                $table->string('create_new_page')->default('yes');
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
        if(Schema::hasColumn('services', 'create_new_page')) {

            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('create_new_page');
            });
        }
    }
};
