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
        Schema::create('lawyer_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('gender')->nullable();
            $table->integer('alternative_phone')->nullable();
            $table->string('personal_email')->nullable();
            $table->date('exit_date')->nullable();
            $table->string('package_details')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('account_holderName')->nullable();
            $table->string('account_Number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->integer('lawyer_id')->nullable();
            $table->text('attachment')->nullable();
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
        Schema::dropIfExists('lawyer_profiles');
    }
};
