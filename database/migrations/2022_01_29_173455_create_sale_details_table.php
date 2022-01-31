<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sale_details');
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('sale_id')->unsigned()->nullable();
            $table->text('number');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('sale_id')
                ->references('id')
                ->on('sales')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_details');
    }
}
