<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("invoice_id");
            $table->foreignId("item_id");
            $table->integer("quantity");
            $table->float("price");
            $table->float("total");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("invoice_id")->references("id")->on("invoices")->onDelete("cascade");
            $table->foreign("item_id")->references("id")->on("items")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
