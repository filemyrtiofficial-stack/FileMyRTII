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
        if(!Schema::hasColumn('notifications', 'additional')) {

            Schema::table('notifications', function (Blueprint $table) {
                $table->json('additional')->nullable();
            });
        }
        if(!Schema::hasColumn('notifications', 'is_read')) {

            Schema::table('notifications', function (Blueprint $table) {
                $table->boolean('is_read')->default(0);
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
        if(Schema::hasColumn('notifications', 'additional')) {

            Schema::table('notifications', function (Blueprint $table) {
                $table->dropColumn('additional');
            });
        }
        if(Schema::hasColumn('notifications', 'is_read')) {

            Schema::table('notifications', function (Blueprint $table) {
                $table->dropColumn('is_read');
            });
        }
    }
};
