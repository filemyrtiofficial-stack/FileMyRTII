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
        if(!Schema::hasColumn('service_templates', 'title')) {

            Schema::table('service_templates', function (Blueprint $table) {
                $table->text('title')->nullable();
            });
        }
        if(!Schema::hasColumn('service_templates', 'sub_title')) {

            Schema::table('service_templates', function (Blueprint $table) {
                $table->text('sub_title')->nullable();
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
        if(!Schema::hasColumn('service_templates', 'title')) {

            Schema::table('service_templates', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }
        if(!Schema::hasColumn('service_templates', 'sub_title')) {

            Schema::table('service_templates', function (Blueprint $table) {
                $table->dropColumn('sub_title');
            });
        }
    }
};
