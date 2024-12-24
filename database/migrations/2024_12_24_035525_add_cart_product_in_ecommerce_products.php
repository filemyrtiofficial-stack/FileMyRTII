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
        if(!Schema::hasColumn('ecommerce_products', 'visible_on_cart')) {
            
            Schema::table('ecommerce_products', function (Blueprint $table) {
                $table->text('visible_on_cart')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('ecommerce_products', 'visible_on_cart')) {
            
            Schema::table('ecommerce_products', function (Blueprint $table) {
                $table->dropColumn('visible_on_cart');
            });
        }
    }
};
