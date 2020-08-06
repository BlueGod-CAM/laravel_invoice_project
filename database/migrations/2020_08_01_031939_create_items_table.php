<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name");
            $table->text("description");
            $table->float("sale_price");
            $table->float("purchase_price");
            $table->integer("quantity");
            $table->foreignId("category_id");
            $table->boolean("enabled");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
