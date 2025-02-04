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
        Schema::create('application_enquiries', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id')->nullable();
            $table->text('query')->nullable();
            $table->text('reply')->nullable();
            $table->json('documents')->nullable();
            $table->integer('status')->nullable(1);
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
        Schema::dropIfExists('application_enquiries');
    }
};
