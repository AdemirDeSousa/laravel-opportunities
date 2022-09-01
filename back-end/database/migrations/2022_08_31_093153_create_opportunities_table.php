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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('client_id')->index()->nullable();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('product_id')->index()->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('seller_id')->index()->nullable();
            $table->foreign('seller_id')->references('id')->on('sellers');
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
        Schema::dropIfExists('opportunities');
    }
};
