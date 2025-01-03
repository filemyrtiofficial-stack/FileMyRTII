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
        Schema::create('service_category_data', function (Blueprint $table) {
            $table->id();
            $table->integer('service_category_id')->nullable();
            $table->integer('template_section_id')->nullable();
            $table->text('data')->nullable();
            $table->integer('sequance')->default(1);
            $table->string('section_key')->nullable();
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
        Schema::dropIfExists('service_category_data');
    }
};
