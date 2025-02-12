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
            $table->integer('lawyer_id');
            $table->string('father_spouse_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('alternative_phone_no')->nullable();
            $table->string('personal_email_id')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->text('package_details')->nullable();
            $table->string('bank_account_holder')->nullable();
            $table->string('bank_name')->nullable();
            $table->text('bank_address')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_ifsc_code')->nullable();      
            $table->json('attachments')->nullable();
            $table->string('blood_group')->nullable();
            $table->date('exit_date')->nullable();
            $table->text('remarks')->nullable();
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
