<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('customer_id');
            $table->double('amount');
            $table->dateTime('due_date');
            $table->integer('vat');
            $table->boolean('is_vat_inclusive')->default(0);
            $table->string('status');
            $table->double('amount_with_vat');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->foreign('customer_id')->references('id')->on('users');
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
}
