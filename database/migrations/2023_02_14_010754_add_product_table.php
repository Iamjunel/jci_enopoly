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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->nullable();
            $table->float('supplier_cost',10,3)->nullable();
            $table->integer('multipack')->nullable();
            $table->float('final_supplier_cost',10,3)->nullable();
            $table->float('selling_price',10,3)->nullable();
            $table->float('fba_fees',10,3)->nullable();
            $table->float('label_cost',10,3)->nullable();
            $table->float('shipping_fee',10,3)->nullable();
            $table->float('prep_fee',10,3)->nullable();
            $table->float('inbound_shipment',10,3)->nullable();
            $table->float('profit_per_piece',10,3)->nullable();
            $table->float('total_cost',10,3)->nullable();
            $table->float('total_profit',10,3)->nullable();
            $table->float('margin',10,3)->nullable();
            $table->float('monthly_sales',10,3)->nullable();
            $table->integer('compt_sellers')->nullable();
            $table->string('process')->nullable();
            $table->string('status')->nullable();
            $table->string('qa_status')->nullable();
            $table->string('agent')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        //
        Schema::dropIfExists('products');
    }
};
