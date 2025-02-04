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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('linkable_id')->nullable();
            $table->string('linkable_type')->nullable();
            $table->string('type')->nullable();
            $table->text('message')->nullable();
            $table->integer('from_id')->nullable();
            $table->string('from_type')->nullable();
            $table->integer('to_id')->nullable();
            $table->string('to_type')->nullable();


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
        Schema::dropIfExists('notifications');
    }
};
