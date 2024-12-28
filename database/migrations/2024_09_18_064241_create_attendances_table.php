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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('no')->nullable();
            $table->string('tmno')->nullable();
            $table->string('empno')->nullable();
            $table->string('name')->nullable();
            $table->string('gmno')->nullable();
            $table->string('mode')->nullable();
            $table->string('in_out')->nullable();
            $table->string('anti_pass')->nullable();
            $table->string('proxy')->nullable();
            $table->datetime('date_time')->nullable();
            $table->string('date_time_string')->nullable();

            $table->date('attendance_date')->nullable();
            $table->time('attendance_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
