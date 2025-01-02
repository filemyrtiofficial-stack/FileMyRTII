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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('profile')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('name');
            $table->integer('age');
            $table->date('dob');
            $table->text('address');
            $table->string('emergency_name');
            $table->string('emergency_mobile');
            $table->string('member_relation');
            $table->string('relation');
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
        Schema::dropIfExists('family_members');
    }
};