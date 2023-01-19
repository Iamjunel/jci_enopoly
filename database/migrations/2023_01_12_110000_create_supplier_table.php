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
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('asin')->nullable();
            $table->string('company_name')->nullable();
            $table->string('website_link')->nullable();
            $table->string('notes')->unique();
            $table->string('types')->nullable();
            $table->integer('added_by')->nullable();
            $table->string('status')->default('Incomplete')->nullable();
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
        Schema::dropIfExists('supplier');
    }
};
