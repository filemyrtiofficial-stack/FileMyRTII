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
        Schema::create('rti_appeals', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id')->nullable();
            $table->boolean('received_appeal')->nullable(0);
            $table->integer('appeal_no')->nullable();
            $table->text('reason')->nullable();
            $table->text('document')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('rti_appeals');
    }
};
