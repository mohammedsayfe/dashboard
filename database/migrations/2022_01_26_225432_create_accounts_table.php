<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_number')->unique()->unsigned();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('bank_id');
            $table->bigInteger('balance')->default('0')->unsigned();
            $table->text('statement')->nullable();
            $table->text('branch')->nullable();
            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('cascade');

            $table->foreign('bank_id')
                ->references('id')
                ->on('banks')
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
