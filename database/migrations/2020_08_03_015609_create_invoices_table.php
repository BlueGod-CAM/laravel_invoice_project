<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->integer("invoice_number");
            $table->date("invoice_at");
            $table->float("amount")->nullable();
            $table->string("currency");
            $table->float("total")->nullable();
            $table->foreignId("customer_id");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("customer_id")->references("id")->on("customers")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
