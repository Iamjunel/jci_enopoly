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
        //
        Schema::table('products', function($table) {
            $table->string('inventory_status')->nullable();
            $table->string('amazon_title')->nullable();
            $table->string('asin')->nullable();
            $table->string('upc')->nullable();
            $table->string('notes')->nullable();
            $table->string('category')->nullable();
           
            $table->string('amazon_link')->nullable();
            $table->string('supplier')->nullable();
            $table->string('supplier_link')->nullable();
            $table->string('sku')->nullable();
            $table->string('mark_up')->nullable();
            $table->float('mark_up_price',10,3)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
         Schema::table('products', function($table) {
            $table->dropColumn('inventory_status');
            $table->dropColumn('amazon_title');
            $table->dropColumn('asin');
            $table->dropColumn('upc');
            $table->dropColumn('notes');
            $table->dropColumn('category');
            
            $table->dropColumn('amazon_link');
            $table->dropColumn('supplier');
            $table->dropColumn('supplier_link');
            $table->dropColumn('sku');
            $table->dropColumn('mark_up');
            $table->dropColumn('mark_up_price');
           
            
        });
    }
};
