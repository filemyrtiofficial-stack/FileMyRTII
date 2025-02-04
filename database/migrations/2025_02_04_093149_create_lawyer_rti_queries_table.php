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
        Schema::create('lawyer_rti_queries', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id')->nullable();
            $table->text('message')->nullable();
            $table->text('reply')->nullable();
            $table->json('documents')->nullable();
            $table->integer('from_id')->nullable();
            $table->string('from_user')->nullable();
            $table->integer('to_id')->nullable();
            $table->string('to_user')->nullable();
            $table->boolean('marked_read')->default(false);
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
        Schema::dropIfExists('lawyer_rti_queries');
    }
};
