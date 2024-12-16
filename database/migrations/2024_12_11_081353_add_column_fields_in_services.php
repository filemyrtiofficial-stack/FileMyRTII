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
        if(!Schema::hasColumn('services', 'fields')) {

            Schema::table('services', function (Blueprint $table) {
                $table->text('fields')->nullable();
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
        if(Schema::hasColumn('services', 'fields')) {

            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('fields');
            });
        }
    }
};
