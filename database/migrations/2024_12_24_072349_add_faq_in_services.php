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
        if(!Schema::hasColumn('services', 'faq')) {

            Schema::table('services', function (Blueprint $table) {
                $table->text('faq')->nullable();
            });
        }
        if(!Schema::hasColumn('services', 'mobile_banner')) {

            Schema::table('services', function (Blueprint $table) {
                $table->string('mobile_banner')->nullable();
            });
        }
        if(!Schema::hasColumn('services', 'desktop_banner')) {

            Schema::table('services', function (Blueprint $table) {
                $table->string('desktop_banner')->nullable();
            });
        }
        if(!Schema::hasColumn('services', 'image_1')) {

            Schema::table('services', function (Blueprint $table) {
                $table->string('image_1')->nullable();
            });
        }
        if(!Schema::hasColumn('services', 'image_2')) {

            Schema::table('services', function (Blueprint $table) {
                $table->string('image_2')->nullable();
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
        if(Schema::hasColumn('services', 'faq')) {

            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('faq');
            });
        }
        if(Schema::hasColumn('services', 'mobile_banner')) {

            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('mobile_banner');
            });
        }
        if(Schema::hasColumn('services', 'desktop_banner')) {

            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('desktop_banner');
            });
        }
        if(Schema::hasColumn('services', 'image_1')) {

            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('image_1');
            });
        }
        if(Schema::hasColumn('services', 'image_2')) {

            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('image_2');
            });
        }
    }
};
