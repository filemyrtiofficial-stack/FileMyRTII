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
        Schema::create('rti_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->text('application_no')->nullable();
            $table->integer('service_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('service_fields')->nullable();
            $table->float('charges')->nullable();
            $table->integer('status')->default(1);
            $table->integer('lawyer_id')->nullable();
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
        Schema::dropIfExists('rti_applications');
    }
};
