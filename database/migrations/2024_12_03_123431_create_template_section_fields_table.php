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
        Schema::create('template_section_fields', function (Blueprint $table) {
            $table->id();
            $table->integer('template_section_id');
            $table->string('field_lable')->nullable();
            $table->string('machine_key')->nullable();
            $table->string('field_key')->nullable();
            $table->text('field_data')->nullable();

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
        Schema::dropIfExists('template_section_fields');
    }
};
