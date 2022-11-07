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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quantity');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('buyer_id');
            $table->string('currency')->default('AFG');
            $table->foreign('product_id')->on('products')->references('id');
            $table->foreign('buyer_id')->on('users')->references('id');
            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
};