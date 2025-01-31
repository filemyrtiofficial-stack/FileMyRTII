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
        Schema::create('rti_application_trackings', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id')->nullable();
            $table->integer('revision_id')->nullable();
            $table->string('courier_name')->nullable();
            $table->string('courier_tracking_number')->nullable();
            $table->date('courier_date')->nullable();
            $table->float('charges')->nullable();
            $table->text('address')->nullable();
            $table->json('documents')->nullable();
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
        Schema::dropIfExists('rti_application_trackings');
    }
};
