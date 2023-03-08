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
    Schema::table('invoice', function($table) {
            $table->float('discount',10,2)->nullable();
            $table->integer('added_by')->nullable();
            $table->text('notes')->nullable();
            $table->date('invoice_date')->nullable();
            $table->text('payment_due')->nullable();
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
         Schema::table('invoice', function($table) {
            $table->dropColumn('discount');
            $table->dropColumn('added_by');
            $table->dropColumn('notes');
        });
    }
};
