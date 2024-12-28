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
        if(!Schema::hasColumn('blogs', 'author')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->string('author', 255)->nullable();
            });
        }

        if(!Schema::hasColumn('blogs', 'user_id')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->integer('user_id')->nullable();
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
        if(Schema::hasColumn('blogs', 'author')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->dropColumn('author');
            });
        }

        if(Schema::hasColumn('blogs', 'user_id')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
};
