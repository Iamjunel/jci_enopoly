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
        Schema::table('supplier', function($table) {
            $table->integer('checker_id')->nullable();
            $table->string('checker_notes')->nullable();
            $table->dateTime('checker_updated_at')->nullable();
            $table->integer('caller_id')->nullable();
            $table->string('caller_notes')->nullable();
            $table->dateTime('caller_updated_at')->nullable();
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
         Schema::table('supplier', function($table) {
            $table->dropColumn('checker_id');
            $table->dropColumn('checker_notes');
            $table->dropColumn('checker_updated_at');
            $table->dropColumn('caller_id');
            $table->dropColumn('caller_notes');
            $table->dropColumn('caller_updated_at');
        });
    }
};
