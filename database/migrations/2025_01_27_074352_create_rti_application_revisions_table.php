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
        Schema::create('rti_application_revisions', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id')->nullable();
            $table->integer('template_id')->nullable();
            $table->text('details')->nullable();
            $table->text('template')->nullable();
            $table->integer('status')->default(1);
            $table->string('signature')->nullable();
            $table->text('customer_change_request')->nullable();
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
        Schema::dropIfExists('rti_application_revisions');
    }
};
