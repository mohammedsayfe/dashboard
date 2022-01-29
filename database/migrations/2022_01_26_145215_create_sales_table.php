<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('products_id')->unique()->unsigned();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('account_id');
            $table->text('number');
            $table->text('statement')->nullable();


            $table->foreign('products_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');

            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('cascade');



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
        Schema::dropIfExists('accounts');
    }
}
