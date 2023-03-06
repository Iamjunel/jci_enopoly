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
    Schema::table('orders', function($table) {
            $table->integer('store_id')->nullable();
            $table->string('approved_by')->nullable();
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
         Schema::table('orders', function($table) {
            $table->dropColumn('store_id');
            $table->dropColumn('approved_by');
            
        });
    }
};
